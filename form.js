var x = 1;
var y = 1;
var z = 1;
var a = 1;
var b = 1;
var c = 1;
var img;
function remove(id) {
  $("." + id).remove();
  --x;
}
function remove2(id) {
  $("." + id).remove();
  --y;
}

function remove3(id) {
  $("." + id).remove();
  --b;
}

function remove4(id) {
  $("." + id).remove();
  --z;
}

function remove5(id) {
  $("." + id).remove();
  --a;
}

function remove6(id) {
  $("." + id).remove();
  --c;
}
$(document).ready(function () {
  var add_button = $("#Add");
  var add_button1 = $("#Add1");
  var add_button2 = $("#Add2");
  var add_button3 = $("#Adds");
  var add_button4 = $("#Add3");
  var add_button5 = $("#Add4");

  $(add_button).click(function (e) {
    e.preventDefault();
    $("#Experience").append(
      '<div class="' +
        x +
        '" style="margin-top:10px"><form><div class="form-group mb-3 input-group-sm" id="Experience"><label><b>Company name :</b></label><input type="text" class="form-control" id="company0" name="company"></form><form><div class="form-group mb-3 input-group-sm" id="Experience"><label><b>City of Company :</b></label>                           <input type="text" class="form-control" id="error" name="Desc"></div></form><form><div class="form-group mb-3 input-group-sm" id="Experience"><label><b>Country in Company :</b></label><input type="text" class="form-control" id="country0" name="Desc"></div></form><form><div class="form-group mb-3 input-group-sm"><label for="graduate_highschool"><b>Date :</b></label><br><input type="month" class="form-control" id="year0"></div></form><form><div class="form-group mb-3 input-group-sm" id="Experience"><label><b>Position in Company :</b></label><input type="text" class="form-control" id="position0" name="Desc"></div></form><div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" name="intern2" id="intern2">intern</label></div><div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" name="intern2" id="intern2">not intern</label></div><br><form><div class="form-group mb-3 input-group-sm" id="Experience"><label><b>Job Description :</b></label><input type="text" class="form-control" id="jobdesc0" name="Desc"></div></form><form><div class="form-group mb-3 input-group-sm" id="Experience"><label><b>Job Detail : </b></label><li><input id="jobdet03" class="form-control" type="text"></li><br><li><input id="jobdet02" class="form-control" type="text"></li><br><li><input id="jobdet01" class="form-control" type="text"></li></div></div></form><hr><button id="' +
        x +
        '" class="remove" onclick=remove("' +
        x +
        '")>X</button></fieldset></div>'
    );
    x++;
  });
  $(add_button1).click(function (e) {
    e.preventDefault();
    $("#atas").append(
      '<div class="info' +
        y +
        '" style="margin-top:10px"><form><div class="form-group mb-3 input-group-sm" id="atas"><label><b>Organization :</b></label><input type="text" class="form-control" id="org" placeholder="Organization Name"><input type="text" class="form-control" id="org0" placeholder="Position on Organization "><input type="text" class="form-control" id="org1" placeholder="Organization Detail"><label>Date :</label><input id="year011" class="form-control" type="month"></div></form><hr><button id="raema' +
        y +
        '" class="remove2" type="button" onclick=remove2("info' +
        y +
        '")>X</button></div>'
    );
    y++;
  });

  $(add_button2).click(function (e) {
    e.preventDefault();
    $("#atas1").append(
      '<div class="infos' +
        b +
        '" style="margin-top:10px"><form><div class="form-group mb-3 input-group-sm" id="atas1"><label><b>Other Experience :</b></label></span>              <input id="other0" class="form-control" type="text" placeholder="Name of Company"><input id="other1" class="form-control" type="text" placeholder="Position on Company"><input id="other2" class="form-control" type="text" placeholder="Detail of Job"><label>Date :</label><input id="year011" class="form-control" type="month"><hr></div></form><hr><button id="ream' +
        b +
        '" class="remove3" type="button" onclick=remove3("infos' +
        b +
        '")>X</button></div>'
    );
    b++;
  });

  $(add_button3).click(function (e) {
    e.preventDefault();
    $("#PL").append(
      '<div class="Language' +
        z +
        '" class="box1" style="margin-top: 10px;"><div><input class="input-field" type="text" size="40" placeholder="Enter Programming Language"><button type="button" id="remaaaa' +
        z +
        '" class="remove4"  onclick=remove4("Language' +
        z +
        '")>X</button></div></div>'
    );
    z++;
  });

  $(add_button4).click(function (e) {
    e.preventDefault();
    $("#language").append(
      '<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"></head><body><div class="jobdet' +
        a +
        '" style="padding-top: 10px;"><form><div class="form-group mb-3 input-group-sm" id="language"><label for="English"><b>Language :</b></label><input type="text" id="English" class="form-control" name="English" placeholder="Language"></form><form><div class="form-group mb-3 input-group-sm" id="language"><label for="testlanguage"><b>Language test :</b></label><input type="text" id="test_language" class="form-control" name="test_language" placeholder="Test language"></div></form><form><div class="form-group mb-3 input-group-sm" id="language">		<label for="English"><b>Language proficient :</b></label></div></form><div class="form-check" id="language"><label class="form-check-label "><input type="radio" class="form-check-input" name="languagep4" value="Standard" id="languagep4">Proficient</label></div><div class="form-check" id="language"><label class="form-check-label"><input type="radio" class="form-check-input" name="languagep4" value="High Profecient" id="languagep4">High Profecient</label></div><br><div class="form-check-inline" id="language"><label class="form-check-label"><input type="checkbox" id="languagep1" class="form-check-input" name="languagep1" value="Writing">Writing</label></div><br><div class="form-check-inline"><label class="form-check-label"><input type="checkbox" class="form-check-input" id="languagep2" name="languagep2" value="Speaking">Speaking</label></div><br><div class="form-check-inline"><label class="form-check-label"><input type="checkbox" id="languagep3" class="form-check-input" name="languagep3" value="Listening">Listening</label></div><br><br> <form><div class="form-group mb-3 input-group-sm" id="language"><label for="testscore"><b>Test Score :</b></label><input type="text" class="form-control" id="test_score" name="test_score" placeholder="test score"></div></form></div><br><hr><button type="button" id="aa' +
        a +
        '" class="remove5" onclick=remove5("jobdet' +
        a +
        '")>X</button></div><script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script></body>'
    );
    a++;
  });

  $(add_button5).click(function (e) {
    e.preventDefault();
    $("#atas12").append(
      '<div class="award' +
        c +
        '" style="margin-top:10px"><form><div class="form-group mb-3 input-group-sm" id="atas12"><label><b>Award :</b></label><input id="award0" class="form-control" type="text" placeholder="Name of Award"><label>Date :</label><input id="year0111" class="form-control" type="month"><hr></div></form><hr><button id="remi' +
        c +
        '" class="remove6" type="button" onclick=remove6("award' +
        c +
        '")>X</button></div>'
    );
    c++;
  });

  $("#Programming").click(function () {
    if ($(this).prop("checked")) {
      $(".box1").show("slow");
    } else {
      $(".box1").hide();
    }
  });
  $("#MobAp").click(function () {
    if ($(this).prop("checked")) {
      $("#box2").show("slow");
    } else {
      $("#box2").hide();
    }
  });
  $("#Database").click(function () {
    if ($(this).prop("checked")) {
      $("#box3").show("slow");
    } else {
      $("#box3").hide();
    }
  });
  $("#Operatingsystem").click(function () {
    if ($(this).prop("checked")) {
      $("#box4").show("slow");
    } else {
      $("#box4").hide();
    }
  });
  $("#Computer").click(function () {
    if ($(this).prop("checked")) {
      $("#box5").show("slow");
    } else {
      $("#box5").hide();
    }
  });
  $("#Routing").click(function () {
    if ($(this).prop("checked")) {
      $("#Box1").show("slow");
    } else {
      $("#Box1").hide();
    }
  });
  $("#Introduction").click(function () {
    if ($(this).prop("checked")) {
      $("#Box2").show("slow");
    } else {
      $("#Box2").hide();
    }
  });
  var dropdown = document.getElementsByClassName("dropdown-btn");
  var i;

  for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function () {
      this.classList.toggle("active");
      var dropdownContent = this.nextElementSibling;
      if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
      } else {
        dropdownContent.style.display = "block";
      }
    });
  }
});
