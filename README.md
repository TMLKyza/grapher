# grapher
php applicative to parse xlsx ods and csv to gnuplot-like outputfile

Usage:
grapher [input_file_path] 'columns' -o [options_file_path] -s [sheet_number]

'columns': defines which columns to select, uses a non alphabetical char as a divider. You must use apexes to it to work.<br/>
           Examples: 'A,b,T,d' or 'a B e' and so on.<br/>
-o:        allows to use a file to customize the graph. To know more see gnuplot manual<br/>
-s:        selects the sheet the table is in. Sheets indexing starts from 0. If not specified will use sheet 0<br/>


# Install
clone the repository with git clone and run the makefile with sudo 
