cd c:/backup

mkdir REAL-%date:~-4%-%date:~8,2%-%date:~5,2%
cd REAL-%date:~-4%-%date:~8,2%-%date:~5,2% 
mysqldump -u root  real_academia>REAL_%date:~-4%-%date:~8,2%-%date:~5,2%_20-00-00.sql