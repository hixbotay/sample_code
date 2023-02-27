# Sample function excel
Select other sheet
```
=SUM('product_sheet'!A:A)
```
Query
```
=UNIQUE(QUERY('sheet name'!B2:B;"SELECT * where A>0";1))
```

Calculate price product with column A is price, column B is quantity
```
=SUMPRODUCT(A:A;B:B)
```
SUM IFS
```
=SUMIFS(sum_range; criteria_range1; criterion1; [criteria_range2; …]; [criterion2; …])
=SUMIFS(A:A;B:B;C2)
```
Merger string
```
=B2&" "&C2
```
Vlookup
```
=VLOOKUP(search_key; range; index; [is_sorted])
```
