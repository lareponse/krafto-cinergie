SELECT
 ROUND(SUM(LENGTH(`province`)<10)*100/COUNT(`province`),2) AS pct_length_10,
 ROUND(SUM(LENGTH(`province`)<20)*100/COUNT(`province`),2) AS pct_length_20,
 ROUND(SUM(LENGTH(`province`)<30)*100/COUNT(`province`),2) AS pct_length_30,
 ROUND(SUM(LENGTH(`province`)<40)*100/COUNT(`province`),2) AS pct_length_40,
 ROUND(SUM(LENGTH(`province`)<50)*100/COUNT(`province`),2) AS pct_length_50,
 ROUND(SUM(LENGTH(`province`)<60)*100/COUNT(`province`),2) AS pct_length_60,
 ROUND(SUM(LENGTH(`province`)<70)*100/COUNT(`province`),2) AS pct_length_70,
 ROUND(SUM(LENGTH(`province`)<80)*100/COUNT(`province`),2) AS pct_length_80,
 ROUND(SUM(LENGTH(`province`)<90)*100/COUNT(`province`),2) AS pct_length_90,
 ROUND(SUM(LENGTH(`province`)<100)*100/COUNT(`province`),2) AS pct_length_100,
 ROUND(SUM(LENGTH(`province`)<200)*100/COUNT(`province`),2) AS pct_length_200
FROM `locus`;


SELECT
 ROUND(SUM(LENGTH(`locality`)<10)*100/COUNT(`locality`),2) AS pct_length_10,
 ROUND(SUM(LENGTH(`locality`)<20)*100/COUNT(`locality`),2) AS pct_length_20,
 ROUND(SUM(LENGTH(`locality`)<30)*100/COUNT(`locality`),2) AS pct_length_30,
 ROUND(SUM(LENGTH(`locality`)<40)*100/COUNT(`locality`),2) AS pct_length_40,
 ROUND(SUM(LENGTH(`locality`)<50)*100/COUNT(`locality`),2) AS pct_length_50,
 ROUND(SUM(LENGTH(`locality`)<60)*100/COUNT(`locality`),2) AS pct_length_60,
 ROUND(SUM(LENGTH(`locality`)<70)*100/COUNT(`locality`),2) AS pct_length_70,
 ROUND(SUM(LENGTH(`locality`)<80)*100/COUNT(`locality`),2) AS pct_length_80,
 ROUND(SUM(LENGTH(`locality`)<90)*100/COUNT(`locality`),2) AS pct_length_90,
 ROUND(SUM(LENGTH(`locality`)<100)*100/COUNT(`locality`),2) AS pct_length_100,
 ROUND(SUM(LENGTH(`locality`)<200)*100/COUNT(`locality`),2) AS pct_length_200
FROM `locus`;
