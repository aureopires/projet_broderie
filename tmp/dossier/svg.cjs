const sharp=require('C:/Users/aureo/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/sharp');
(async()=>{for(const [a,b] of [['02-wireframes-desktop','wireframe-web'],['04-maquettes-desktop','maquette-web']]) await sharp('output/design/nouveaux-svg/'+a+'/demande-de-devis.svg').png().toFile('tmp/dossier/'+b+'.png');})();
