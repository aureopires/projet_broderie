const fs = require('node:fs');
const vm = require('node:vm');
const assert = require('node:assert/strict');
const code = fs.readFileSync('assets/scripts/theme.js','utf8');
function boot(saved){
 const classes = new Set();
 const list = s => ({toggle(k,v){const on=v===undefined?!s.has(k):v;on?s.add(k):s.delete(k);return on;}});
 const buttons=[0,1].map(()=>({attrs:{},events:{},icon:{classList:list(new Set())},querySelector(){return this.icon;},setAttribute(k,v){this.attrs[k]=v;},addEventListener(k,f){this.events[k]=f;}}));
 const logos=[{},{}];const storage=new Map(saved===null?[]:[['site-theme',saved]]);const listeners={};
 const document={body:{classList:list(classes)},querySelectorAll:s=>s==='[data-theme-toggle]'?buttons:logos,addEventListener:(k,f)=>listeners[k]=f};
 vm.runInNewContext(code,{document,localStorage:{getItem:k=>storage.get(k)??null,setItem:(k,v)=>storage.set(k,v)}});
 listeners.DOMContentLoaded();return{classes,buttons,logos,storage};
}
let a=boot(null);assert(!a.classes.has('dark-mode'));
a.buttons[0].events.click();assert(a.classes.has('dark-mode'));assert.equal(a.storage.get('site-theme'),'dark');
assert(a.buttons.every(b=>b.attrs['aria-label']==='Activer le mode clair'));assert(a.logos.every(l=>l.src.endsWith('logo_nav_dark.png')));
let b=boot(a.storage.get('site-theme'));assert(b.classes.has('dark-mode'));
b.buttons[1].events.click();assert(!b.classes.has('dark-mode'));assert.equal(b.storage.get('site-theme'),'light');
assert(b.buttons.every(b=>b.attrs['aria-label']==='Activer le mode sombre'));assert(b.logos.every(l=>l.src.endsWith('logo_nav.png')));
assert(!boot('invalid').classes.has('dark-mode'));
console.log('PASS: default light, click dark, saved state restored, return light, unknown value fallback; button labels and logos synchronized. Simulated DOM, no browser visual test.');
