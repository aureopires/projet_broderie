exec(open('tmp/dossier/figures.py',encoding='utf-8-sig').read())
diagram('mpd',[(40,35,'user','PK id | UQ email\nroles JSON'),(550,35,'review','PK id | FK user_id NOT NULL\nFK product_id NULL'),(1050,35,'product','PK id | slug\nis_active'),(40,430,'quote_request','PK id | FK user_id NULL\nstatus | logo'),(550,430,'product_category','PK FK product_id\nPK FK category_id'),(1050,430,'category','PK id | slug\nname')],[(0,1,'id / user_id'),(0,3,'id / user_id'),(1,2,'product_id / id'),(2,4,'id / product_id'),(4,5,'category_id / id')],(1500,640))

