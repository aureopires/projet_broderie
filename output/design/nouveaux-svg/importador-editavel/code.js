figma.showUI(__html__, {width:440,height:440});
const rgb=h=>({r:parseInt(h.slice(1,3),16)/255,g:parseInt(h.slice(3,5),16)/255,b:parseInt(h.slice(5,7),16)/255});
const solid=h=>[{type:'SOLID',color:rgb(h)}];
const fonts=new Map();const substituted=new Set();
async function fontFor(n){
  const style=n.bold?(n.italic?'Bold Italic':'Bold'):(n.italic?'Italic':'Regular');
  const family=n.serif?'Times New Roman':'Arial';const key=family+'/'+style;
  if(fonts.has(key))return fonts.get(key);
  for(const candidate of [{family,style},{family:n.serif?'Libre Baskerville':'Inter',style},{family:'Inter',style:n.bold?'Bold':'Regular'}]){
    try{await figma.loadFontAsync(candidate);fonts.set(key,candidate);if(candidate.family!==family)substituted.add(family+' → '+candidate.family);return candidate}catch(e){}
  }
  throw Error('Não foi possível carregar fontes para '+key);
}
function wireColor(c){if(c==='#FFFFFF'||c==='#FDFBF7')return '#FFFFFF';if(c==='#F8F9FA')return '#EEEEEE';if(c==='#DEE2E6'||c==='#EAE5DE')return '#C8C8C8';if(['#2C2522','#555555','#777777','#6C757D'].includes(c))return '#252525';return '#707070'}
function svgIcon(n,wire){return '<svg xmlns="http://www.w3.org/2000/svg" width="'+n.w+'" height="'+n.h+'" viewBox="'+n.viewBox+'" fill="'+(wire?wireColor(n.fill):n.fill)+'">'+n.paths.map(d=>'<path d="'+d+'"/>').join('')+'</svg>'}
function decode64(s){const alphabet='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';const bytes=[];let acc=0,bits=0;for(const ch of s){const v=alphabet.indexOf(ch);if(v<0)continue;acc=(acc<<6)|v;bits+=6;if(bits>=8){bits-=8;bytes.push((acc>>bits)&255)}}return new Uint8Array(bytes)}
async function makeText(n,wire){const node=figma.createText();node.fontName=await fontFor(n);node.fontSize=n.size;node.lineHeight={unit:'PIXELS',value:n.lineHeight};node.letterSpacing={unit:'PIXELS',value:n.spacing||0};node.characters=n.text;node.fills=solid(wire?wireColor(n.color):n.color);node.textAlignHorizontal=n.align==='center'?'CENTER':n.align==='right'?'RIGHT':'LEFT';node.resize(n.w+1,Math.max(n.h,1));node.textAutoResize='HEIGHT';return node}
figma.ui.onmessage=async msg=>{
  if(msg.type!=='import')return;
  try{
    const data=msg.bundle;
    const screens=data.screens.filter(s=>msg.scope==='all'||msg.scope==='brief'&&s.id.startsWith('brief-client')||msg.scope==='wire'&&s.wire||msg.scope==='hd'&&!s.wire&&!s.id.startsWith('brief-client')||msg.scope==='desktop'&&!s.wire&&s.id.endsWith('desktop')&&!s.id.startsWith('brief-client')||msg.scope==='mobile'&&!s.wire&&s.id.endsWith('mobile'));
    if(!screens.length)throw Error('Nenhuma tela selecionada.');
    await figma.loadAllPagesAsync();const pages=new Map(),hashes=new Map();let first,created=0,skipped=0;
    for(const s of screens){
      let entry=pages.get(s.page);
      if(!entry){let page=figma.root.children.find(p=>p.name===s.page);if(!page){page=figma.createPage();page.name=s.page}entry={page,x:0};pages.set(s.page,entry)}
      if(entry.page.children.some(n=>n.getPluginData('aiguille-screen-id')===s.id)){skipped++;continue}
      const frame=figma.createFrame();entry.page.appendChild(frame);frame.name=s.name;frame.resize(s.width,s.height);frame.fills=solid(s.wire?wireColor(s.background):s.background);frame.x=entry.x;entry.x+=s.width+120;frame.setPluginData('aiguille-screen-id',s.id);first=first||frame;
      let activeGroup=null,origin={x:0,y:0},start=0;
      for(let i=0;i<s.nodes.length;i++){
        const n=s.nodes[i];
        if(i===0||n.group!==s.nodes[i-1].group){
          let end=i+1;while(end<s.nodes.length&&s.nodes[end].group===n.group)end++;
          const chunk=s.nodes.slice(i,end);const minX=Math.min(...chunk.map(n=>n.x)),minY=Math.min(...chunk.map(n=>n.y));const maxX=Math.max(...chunk.map(n=>n.x+n.w)),maxY=Math.max(...chunk.map(n=>n.y+n.h));
          activeGroup=figma.createFrame();frame.appendChild(activeGroup);activeGroup.name=n.group;activeGroup.resize(Math.max(1,maxX-minX),Math.max(1,maxY-minY));activeGroup.fills=[];activeGroup.clipsContent=false;activeGroup.x=minX;activeGroup.y=minY;origin={x:minX,y:minY};
        }
        let node,labelNode;
        if(n.type==='text')node=await makeText(n,s.wire);
        else if(n.type==='icon')node=figma.createNodeFromSvg(svgIcon(n,s.wire));
        else if(n.type==='image'&&s.wire){
          node=figma.createNodeFromSvg('<svg xmlns="http://www.w3.org/2000/svg" width="'+n.w+'" height="'+n.h+'"><rect width="100%" height="100%" fill="#DDDDDD" stroke="#BBBBBB"/><path d="M0 0L'+n.w+' '+n.h+'M'+n.w+' 0L0 '+n.h+'" stroke="#B8B8B8"/></svg>');
          labelNode=await makeText({size:Math.min(22,Math.max(10,n.w/10)),bold:false,serif:false,italic:false,lineHeight:28,spacing:0,text:/logo/i.test(n.name)?'LOGO':'IMAGE',color:'#555555',align:'center',w:n.w-8,h:28},true);
        }else{
          node=figma.createRectangle();node.resize(n.w,Math.max(n.h,1));node.cornerRadius=n.r||0;
          if(n.type==='image'){
            let hash=hashes.get(n.key);if(!hash){hash=figma.createImage(decode64(data.assets[n.key].data)).hash;hashes.set(n.key,hash)}
            node.fills=[{type:'IMAGE',imageHash:hash,scaleMode:n.fit==='contain'?'FIT':'FILL'}];
          }else{node.fills=solid(s.wire?wireColor(n.fill):n.fill);if(n.stroke){node.strokes=solid(s.wire?wireColor(n.stroke):n.stroke);node.strokeWeight=1}}
          if(n.shadow&&!s.wire)node.effects=[{type:'DROP_SHADOW',color:{r:.17,g:.15,b:.13,a:.09},offset:{x:0,y:2},radius:3,spread:0,visible:true,blendMode:'NORMAL'}];
        }
        activeGroup.appendChild(node);node.name=n.name;node.x=n.x-origin.x;node.y=n.y-origin.y;
        if(labelNode){activeGroup.appendChild(labelNode);labelNode.x=n.x-origin.x+4;labelNode.y=n.y-origin.y+n.h/2-14;labelNode.name='Image / repère'}
      }
      created++;figma.ui.postMessage({type:'progress',text:created+'/'+screens.length+' — '+s.name});
    }
    if(first){await figma.setCurrentPageAsync(first.parent);figma.currentPage.selection=[first];figma.viewport.scrollAndZoomIntoView([first])}
    const note=substituted.size?'\nFontes substituídas: '+Array.from(substituted).join(', '):'';
    figma.notify(created+' telas importadas');figma.ui.postMessage({type:'done',text:created+' telas importadas; '+skipped+' já existentes. Textos, formas e fotos editáveis.'+note});
  }catch(e){figma.ui.postMessage({type:'error',text:String(e)})}
};
