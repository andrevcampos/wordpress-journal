// JavaScript Document

function journalbuttonsave(url, redirect) {

    
    document.getElementById("bm-journal-button").style.display = "none";
    document.getElementById("journalmessage2").style.display = "block";
    document.getElementById("journalmessage2").innerHTML = "Saving";

    var imageurl2 = document.getElementById("image_urll2").value;

    var title = document.getElementById("journaltitle").value;
    var subtitle = document.getElementById("journalsubtitle").value;
    var message = document.getElementById("journalmessage").value;
    var link = document.getElementById("journallink").value;
    

    if(imageurl2 != ""){
        const words2 = imageurl2.split('uploads/');
        imageurl2 = words2[1];
    }

    var newurl = url + "?imageurl=" + imageurl2 + "&title=" + title + "&subtitle=" + subtitle + "&message=" + message + "&link=" + link;

    //console.log(newurl);

    //document.getElementById("bm-pdf-button").style.color = "#ff0000";

    var xhttp;

	xhttp=new XMLHttpRequest();

	xhttp.onreadystatechange = function() {

	if (this.readyState == 4 && this.status == 200) {
        window.location.href = redirect + "/admin.php?page=my-menu-journal";
	}
	};
	xhttp.open("GET", newurl, true);
	xhttp.send();
}

function ejournalbuttonsave(url, jid, redirect) {

    
    document.getElementById("ebm-journal-button").style.display = "none";
    document.getElementById("ejournalmessage2").style.display = "block";
    document.getElementById("ejournalmessage2").innerHTML = "Saving";

    var imageurl2 = document.getElementById("eimage_urll2").value;
    var title = document.getElementById("ejournaltitle").value;
    var subtitle = document.getElementById("ejournalsubtitle").value;
    var message = document.getElementById("ejournalmessage").value;
    var link = document.getElementById("ejournallink").value;

    if(imageurl2 != ""){
        let result = imageurl2.includes("uploads/");
        if(result){
            const words2 = imageurl2.split('uploads/');
            imageurl2 = words2[1];
        }
    }

    var newurl = url + "?imageurl=" + imageurl2 + "&title=" + title + "&subtitle=" + subtitle + "&message=" + message + "&link=" + link + "&jid=" + jid;
    console.log(newurl);

    var xhttp;

	xhttp=new XMLHttpRequest();

	xhttp.onreadystatechange = function() {

	if (this.readyState == 4 && this.status == 200) {
        window.location.href = redirect + "/admin.php?page=my-menu-journal";
	}
	};
	xhttp.open("GET", newurl, true);
	xhttp.send();
}

function djournalbuttonsave(url, jid, redirect) {

    document.getElementById("dbm-journal-button").style.display = "none";
    document.getElementById("djournalmessage2").style.display = "block";
    document.getElementById("djournalmessage2").innerHTML = "deleting...";

    var newurl = url + "?jid=" + jid;
    console.log(newurl);

    var xhttp;
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
        window.location.href = redirect + "/admin.php?page=my-menu-journal";
	}
	};
	xhttp.open("GET", newurl, true);
	xhttp.send();
}

function journaldisplaymore() {

    let lastindex = parseInt(document.getElementById("jnlastindex").innerHTML);
    let totalindex = parseInt(document.getElementById("jntotalindex").innerHTML);

    for (let i = 0; i < 5; i++) {
        if(lastindex < totalindex){
            lastindex = lastindex + 1;
            var boxid = "box_" + lastindex;
            document.getElementById(boxid).style.display="block";
            document.getElementById("jnlastindex").innerHTML = lastindex;
        }else{
            document.getElementById("jnbutton").style.display="none"
        }
    }
}