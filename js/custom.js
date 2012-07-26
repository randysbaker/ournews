function writeCurDate(id,lang)
{
    var obj = document.getElementById(id);
    var dt = new Date();
    var year = dt.getFullYear();
    var monthNum = dt.getMonth();
    var month = getMonth(monthNum,lang);
    var day = dt.getDate();
    if(obj)
        obj.innerHTML = month + ' ' + day + ', ' + year;
}

function getMonth(monthNum, lang)
{

    var mo;
    if(lang == 'en')
    {
        mo = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
    }
    else if(lang == 'es')
    {
        mo = new Array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
    }
    else
    {
        mo = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
    }

    return mo[monthNum];
}


function writeTodaysNewsUrl()
{
    obj = document.getElementById('todays_news_href');
    var dt = new Date();
    var year = dt.getFullYear();
    var month = dt.getMonth()+1;
    var day = dt.getDate();

    if(day < 10)
        day = '0' + new String(day);

    if(month < 10)
        month = '0' + new String(month);

    if(obj)
        obj.href = '/news/' + year + month + day + '.htm';

}