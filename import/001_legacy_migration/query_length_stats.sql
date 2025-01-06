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
 ROUND(SUM(LENGTH(`label`)<10)*100/COUNT(`label`),2) AS pct_length_10,
 ROUND(SUM(LENGTH(`label`)<20)*100/COUNT(`label`),2) AS pct_length_20,
 ROUND(SUM(LENGTH(`label`)<30)*100/COUNT(`label`),2) AS pct_length_30,
 ROUND(SUM(LENGTH(`label`)<40)*100/COUNT(`label`),2) AS pct_length_40,
 ROUND(SUM(LENGTH(`label`)<50)*100/COUNT(`label`),2) AS pct_length_50,
 ROUND(SUM(LENGTH(`label`)<60)*100/COUNT(`label`),2) AS pct_length_60,
 ROUND(SUM(LENGTH(`label`)<70)*100/COUNT(`label`),2) AS pct_length_70,
 ROUND(SUM(LENGTH(`label`)<80)*100/COUNT(`label`),2) AS pct_length_80,
 ROUND(SUM(LENGTH(`label`)<90)*100/COUNT(`label`),2) AS pct_length_90,
 ROUND(SUM(LENGTH(`label`)<100)*100/COUNT(`label`),2) AS pct_length_100,
 ROUND(SUM(LENGTH(`label`)<200)*100/COUNT(`label`),2) AS pct_length_200
FROM `locus`;
