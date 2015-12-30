//_script.js
document.write("<table border='1' cellpadding='2'>");
document.write("<tr align='center'>","<th colspan='6'>","Search Results","</th>", "</tr>");
document.write("<tr>", "<td width = '250px'>", "Game Title", "</td>","<td width = '150px'>", "Price", "</td>","<td width = '250px'>", "Manufacturer","</td>","<td width = '250px'>", "Release Date" ,"</td>","<td width = '250px'>", "Genre" ,"</td>", "</tr>");

for (i = 1; i <= 10; i++) {
    document.write("<tr align = 'center'>", "<td>","Test Game Title", "</td>","<td>","$19.99", "</td>","<td>","EA Games", "</td>","<td>","2015","</td>","<td>","Role Playing","</td>","</tr>");
    }

function QuerySearch(Search_Request) {

  //Replace For loop with some code to reference a json or a php based database if we have to use that

}

document.write("</table>");
