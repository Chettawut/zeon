SELECT sum(b.amount) as amount ,c.stcode,d.stname1,b.unit,d.type 
FROM womaster a inner join wodetail as b on (a.wocode=b.wocode) inner join bom as c on (b.stcode=c.stcodemain) inner join stock as d on (c.stcode=d.stcode) 
where MONTH(a.wodate) = '5' and YEAR(a.wodate) = '2023' and b.wostatus != 'Cancel' 
 GROUP by stcode;

 SELECT a.stcode ,b.amount ,a.stname1,a.unit,a.type
FROM stock a inner join bom as b on (a.stcode=b.stcode)   
 where b.stcodemain = '100001';