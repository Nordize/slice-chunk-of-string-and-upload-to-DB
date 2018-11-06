<?php

if($_SERVER['SERVER_NAME'] == "localhost") {
		$adminhost = "184.168.74.159";
		//$adminhost = "107.180.69.74";
	} else {
		$adminhost = "localhost";
}

		$adminuser = "dbwebuser";
		$adminpass = "max99q";
		$admindb = "Main_HQ";

//		$adminuser = "acbdemo";
//		$adminpass = "Acb2755";
//		$admindb = "acbdemo";

	// Check to see if person is actually a user.
	$link = mysql_connect($adminhost, $adminuser, $adminpass); //, $admindb );
	if (!$link) {
	    echo "notuser";
   		die('Not connected (1) : ' . mysql_error());
	}

	echo "</br/>We are past the connect!<br/><br/>";
	
	if( !mysql_select_db($admindb, $link)) {
		printf(mysql_error());
	}
	date_default_timezone_set('America/New_York');
#-------------------------------------


?>
<!DOCTYPE html>
<html>
<head>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript" charset="utf8"></script>
  <script src="https://d3js.org//d3.v4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
  
</head>
<body>
<form action="" name="readfile" method="post" enctype="multipart/form-date">
<input type="file" name="file" id="file"/>
<hr>
<input type="submit" name="submitToDB" value="Submit this EMS file to DB"/>

</form>



<script >
function formatPhoneNumber(phoneNumberString) {
  var cleaned = ('' + phoneNumberString).replace(/\D/g, '')
  var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/)
  if (match) {
    return match[1] + '-' + match[2] + '-' + match[3];
  }
  return null;
};

function addDays(date, days) {
  var result = new Date(date);
  result.setDate(result.getDate() + days);
  //return result;
  return (result.getFullYear()+"-"+(result.getMonth() + 1)+"-"+result.getDate());
}


//slice chunk string function
String.prototype.chunkString = function(len) {
    var _ret;
    if (this.length < 1) {
        return [];
    }
    if (typeof len === 'number' && len > 0) {
        var _size = Math.ceil(this.length / len), _offset = 0;
        _ret = new Array(_size);
        for (var _i = 0; _i < _size; _i++) {
            _ret[_i] = this.substring(_offset, _offset = _offset + len);
        }
    }
    else if (typeof len === 'object' && len.length) {
        var n = 0, l = this.length, chunk, that = this;
        _ret = [];
        do {
            len.forEach(function(o) {
                chunk = that.substring(n, n + o);
                if (chunk !== '') {
                    _ret.push(chunk);
                    n += chunk.length;
                }
            });
            if (n === 0) {
                return undefined; // prevent an endless loop when len = [0]
            }
        } while (n < l);
    }
    return _ret;
};

document.getElementById('file').onchange = function(){
    

    var file = this.files[0];
    
    var reader = new FileReader();
    reader.onload = function(progressEvent){
    // Entire file
    console.log(this.result);
	
	
    // By lines
    var lines = this.result.split('\n');
	//document.getElementById('ren_line').textContent = lines;
	
	
	
	//document.write('<tr><th>ndaccnum</th></tr>');
	
	
	var link_arr = [];
	var ar3 = [];
	var object2 = [];
	var object3 = [];
	var dict = [];
	
	
    for(var line = 0; line < lines.length; line++)
	{
	
	  
	  var arr = lines[line].chunkString([9,20,15,10,7,22,30,7,10,30,30,20,2,10,14,11,10,30,25,20,15,30,30,20,2,10,14,25,30,30,30,2,9,15,33,10,17,11,33,24,12,2,9,10,4,22,8,1,2,3,10,2,10]);
	  
	  var nddtentered = moment().format("YYYY-MM-DD HH:MM:SS");
	 
	  var nddtaccopened = arr[3];
      var nddtaccopened_output = nddtaccopened.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
      
      var nddtaccpastdue = arr[8];
      var nddtaccpastdue_output = addDays(nddtaccpastdue,90); //plus 90 days, done
      //var nddtaccpastdue_output = nddtaccpastdue.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

	  
	  var ndrhphone = arr[26]
	  if (ndrhphone == '(777) 777-7777           ')
	  {
	      ndrhphone= '';
	  }else
	  {
	      ndrhphone = formatPhoneNumber(ndrhphone);
	  }
	  
	  var ndrwphone = arr[27]
	  
	  if (ndrwphone == "(777) 777-7777           ")
	  {
	      ndrwphone= "";
	  }else
	  {
	      ndrwphone = formatPhoneNumber(ndrwphone);
	  }
	  
	  var ndowing = arr[7];
	  var ndaddress = arr[21]+' '+arr[22];
      var ndcomment ="Insurance Info / ER Doctor Name: "+arr[28]+' '+arr[34]+' '+arr[35]+' '+arr[36]+' '+arr[45];
      
      var ndrssn = arr[37];
      if (ndrssn == '777-77-7777')
      {
          ndrssn = ''
      }
      
      
	  //link_arr_test = [arr[0],arr[1],arr[2],arr[3],arr[4],arr[7],arr[8],arr[19],arr[20],ndaddress,arr[23],arr[24],arr[25],arr[26],arr[27],ndcomment,arr[37]];
	  link_arr = {nddtentered:nddtentered,ndaccnum:arr[0].trim(),ndlname:arr[1].trim(),ndfname:arr[2].trim(),nddtaccopened:nddtaccopened_output.trim(),ndprincipal:ndowing.trim(),ndowing:ndowing.trim(),nddtaccpastdue:nddtaccpastdue_output,ndrlname:arr[19].trim(),ndrfname:arr[20].trim(),ndraddress:ndaddress.trim(),ndrcity:arr[23].trim(),ndrstate:arr[24].trim(),ndrzipcode:arr[25].trim(),ndrhphone:ndrhphone.trim(),ndrwphone:ndrwphone.trim(),ndcomment:ndcomment.trim(),ndrssn:ndrssn.trim()};
	 
	  //console.log(link_arr_test);
	  console.log(link_arr);
	  
	  //append array DONE
	  object2.push(link_arr);
	  
	  
	  //group by and sum on process
	  var expenseMetrics = d3.nest()
          .key(function(d) { return d.ndaccnum; })
          .key(function(d) { return d.nddtaccopened})
          .rollup(function(v) { return {
            count: v.length,
            total: d3.sum(v, function(d) { return d.ndowing; })
            //avg: d3.mean(v, function(d) { return d.amount; })
          }; })
          .entries(object2);
        
	 
	  
    }
  
    for (var mm=0;mm<expenseMetrics.length;mm++) //loop for ndaccnum row
    {
        console.log(Object.values(expenseMetrics[mm]));
        console.log(Object.values(expenseMetrics[mm])[0]);  //print ndaccnum
        console.log(Object.values(expenseMetrics[mm])[1]);  //print object of each ndaccnum
        
        
        dict_ndaccnum = Object.values(expenseMetrics[mm])[0];
        
        for(var nn=0;nn<Object.values(expenseMetrics[mm])[1].length;nn++) 
        {
          
            console.log(Object.values(expenseMetrics[mm])[1][nn]);  //print object of date
            console.log(JSON.stringify(Object.values(expenseMetrics[mm])[1][nn].key)); // print date value <-already change to string
            console.log(Object.values(expenseMetrics[mm])[1][nn].value.count); //print count
            console.log(Object.values(expenseMetrics[mm])[1][nn].value.total); //print total
            
            //store data in dict with  ndaccnum: multiple date then sort date <---comeback and do this
            //stuck here
            
            
            dict_date = Object.values(expenseMetrics[mm])[1][nn].key;
            
            dict.push({ndaccnum:dict_ndaccnum,date:dict_date});
            
           
            
            
            
            //end here
        }
        
         
        
    }
    
    console.log(dict);
    console.log(link_arr);
    console.log(object2);
    //console.log(Object.values(expenseMetrics)); //show all
    //console.log(Object.values(expenseMetrics[0])[1].count);//show count number work now
    
    
    
    //test POSt function start  WORKKKKK!!!
    var nddtentered_post;
    var ndaccnum_post;
    var ndlname_post;
    var ndfname_post;
    var nddtaccopened_post;
    var ndprincipal_post;
    var ndowing_post;
    var nddtaccpastdue_post;
    var ndrlname_post;
    var ndrfname_post;
    var ndraddress_post;
    var ndrcity_post;
    var ndrstate_post;
    var ndrzipcode_post;
    var ndrhphone_post;
    var ndrwphone_post;
    var ndcomment_post;
    var ndrssn_post;
    
    for(var i=0;i<object2.length;i++)
    {
        nddtentered_post = object2[i].nddtentered;
        ndaccnum_post= object2[i].ndaccnum;
        ndlname_post= object2[i].ndlname;
        ndfname_post= object2[i].ndfname;
        nddtaccopened_post= object2[i].nddtaccopened;
        ndprincipal_post= object2[i].ndprincipal;
        ndowing_post= object2[i].ndowing;
        nddtaccpastdue_post= object2[i].nddtaccpastdue;
        ndrlname_post= object2[i].ndrlname;
        ndrfname_post= object2[i].ndrfname;
        ndraddress_post= object2[i].ndraddress;
        ndrcity_post= object2[i].ndrcity;
        ndrstate_post= object2[i].ndrstate;
        ndrzipcode_post= object2[i].ndrzipcode;
        ndrhphone_post= object2[i].ndrhphone;
        ndrwphone_post= object2[i].ndrwphone;
        ndcomment_post= object2[i].ndcomment;
        ndrssn_post= object2[i].ndrssn;
        
        //use ajax to send multiple rows of data in the same time with POST 
        $.ajax({
        url: "output.php",
        type: "POST",
        data: {nddtentered:nddtentered_post,ndaccnum:ndaccnum_post,ndlname:ndlname_post,ndfname:ndfname_post,nddtaccopened:nddtaccopened_post,ndprincipal:ndprincipal_post,ndowing:ndowing_post,nddtaccpastdue:nddtaccpastdue_post,ndrlname:ndrlname_post,ndrfname:ndrfname_post,ndraddress:ndraddress_post,ndrcity:ndrcity_post,ndrstate:ndrstate_post,ndrzipcode:ndrzipcode_post,ndrhphone:ndrhphone_post,ndrwphone:ndrwphone_post,ndcomment:ndcomment_post,ndrssn:ndrssn_post},
        //data: {nddtentered:nddtentered_post,ndaccnum:ndaccnum_post,ndlname:ndlname_post},
        success: function (data) {
            //alert(data);
            //console.log(data);
        }
    });
        
    }
    //test POSt end

    
    //create d3 table work!!
	  var table = d3.select("body").append("table");
	  var thead = table.append("thead");
	  var tbody = table.append("tbody");
	  
	  //var columns= ["0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16"];
	  var columns= ["nddtentered","ndaccnum","ndlname","ndfname","nddtaccopened","ndprincipal","ndowing","nddtaccpastdue","ndrlname","ndrfname","ndraddress","ndrcity","ndrstate","ndrzipcode","ndrhphone","ndrwphone","ndcomment", "DOS1","OWING1","DOS2","OWING2","DOS3:","OWING3","DOS4:","OWING4","DOS5:","OWING5","SUM_OWING","ndrssn"];
	  
	  thead.append("tr")
	  .selectAll("th")
	  .data(columns)
	  .enter()
	  .append("th")
	  .text(function(d,i)
	  {
	      return d;
	  })
	  
	  var rows = tbody.selectAll("tr")
	  .data(object2)
	  .enter()
	  .append("tr");
	  
	  var cells = rows.selectAll("td")
	  .data(function(row)
	  {
	      return columns.map(function(column)
	      {
	          return{
	              column:column,
	              value:row[column]
	          }
	      })
	  })
	  .enter()
	  .append("td")
	  .text(function(d,i)
	  {
	      return d.value;
	  })
    //create d3 table END
    
    
  };
  reader.readAsText(file);
};


</script>
</body>
</html>
