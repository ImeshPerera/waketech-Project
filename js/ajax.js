function AdminLogin() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var remember = document.getElementById("remember");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("remember", remember.checked);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                window.location = "index.php";
            } else if (text == "S1") {
                alertDangerclose();
                window.location = "Pay.php";
            } else if (text == "E1") {
                AlertDanger('Your Account Is Not Verified Yet. To Verify');
                ApplyAlertBtn('alertnobtn', 'verify.php', 'Click Here', 'btn-danger');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process1.php", true);
    s.send(form);
}

function VerifyAccount() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var verify = document.getElementById("verify");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("verify", verify.value);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                window.location = "signin.php";
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process2.php", true);
    s.send(form);
}

function SubmitLesson() {
    var year = document.getElementById("year");
    var subject = document.getElementById("subject");
    var lessonname = document.getElementById("lessonname");
    var lessondate = document.getElementById("lessondate");
    var uploadfile = document.getElementById("uploadfile");

    var form = new FormData();
    form.append("year", year.value);
    form.append("subject", subject.value);
    form.append("lessonname", lessonname.value);
    form.append("lessondate", lessondate.value);
    form.append("uploadfile", uploadfile.files[0]);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Lesson Listed Successfully.');
                ApplyAlertBtn('alertokbtn', 'Teacher_lessons.php', 'Refresh Page', 'btn-success');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process3.php", true);
    s.send(form);
}

function UserImage() {
    var TheImage = document.getElementById("UserImage");
    var NewImag = document.getElementById("Userprofileimg");

    NewImag.onchange = function() {
        var ImageFile = this.files[0];
        var Url = window.URL.createObjectURL(ImageFile);
        TheImage.src = Url;
        UserImageUpdate();
    }
}

function UserImageUpdate() {
    var Userprofileimg = document.getElementById("Userprofileimg");

    var form = new FormData();

    form.append("uploadfile", Userprofileimg.files[0]);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Image Upload Success.');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process4.php", true);
    s.send(form);
}

function UserDetailUpdate() {
    var name = document.getElementById("name");
    var mobile = document.getElementById("mobile");
    var password = document.getElementById("password");
    var email = document.getElementById("email");

    var form = new FormData();

    form.append("name", name.value);
    form.append("mobile", mobile.value);
    form.append("password", password.value);
    form.append("email", email.value);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Detail Update Success.');
                ApplyAlertBtn('alertokbtn', 'userprofile.php', 'Refresh Page', 'btn-success');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process5.php", true);
    s.send(form);

}

function UploadAssignment() {
    var year = document.getElementById("year");
    var subject = document.getElementById("subject");
    var assiname = document.getElementById("assiname");
    var startdate = document.getElementById("startdate");
    var enddate = document.getElementById("enddate");
    var uploadfile = document.getElementById("uploadfile");

    var form = new FormData();
    form.append("year", year.value);
    form.append("subject", subject.value);
    form.append("assiname", assiname.value);
    form.append("startdate", startdate.value);
    form.append("enddate", enddate.value);
    form.append("uploadfile", uploadfile.files[0]);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Assignment Waiting for Launch.');
                ApplyAlertBtn('alertokbtn', 'Teacher_assignment.php', 'Refresh Page', 'btn-success');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process6.php", true);
    s.send(form);
}

function NewAssignment(id) {
    var NewFile = document.getElementById("uploadfile");

    NewFile.onchange = function() {
        SubmitAssignment(id);
    }

}

function SubmitAssignment(id) {
    var Assignmentid = id;
    var NewFile = document.getElementById("uploadfile");

    var form = new FormData();

    form.append("Assignmentid", Assignmentid);
    form.append("uploadfile", NewFile.files[0]);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Assignment Upload Success.');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process7.php", true);
    s.send(form);

}

function marksubmit(id, aid) {
    var mark = document.getElementById("mark" + id);

    var form = new FormData();

    form.append("studentid", id);
    form.append("Assignmentid", aid);
    form.append("mark", mark.value);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Marks Listed Successfully.');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process8.php", true);
    s.send(form);
}

function InviteNew(id) {
    var name = document.getElementById("name");
    var password = document.getElementById("password");
    var email = document.getElementById("email");
    var typeid = id;

    var form = new FormData();

    form.append("name", name.value);
    form.append("password", password.value);
    form.append("email", email.value);
    form.append("typeid", typeid);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Student Invite Success.');
                ApplyAlertBtn('alertokbtn', 'Acadamic_manage_student.php', 'Refresh Page', 'btn-success');
            } else if (text == "Message could not be sent. Mailer Error: SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting") {
                AlertSuccess('Database Update Success. No Mail due to Google Third Party application Policy');
                ApplyAlertBtn('alertokbtn', 'Acadamic_manage_student.php', 'Refresh Page', 'btn-success');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process9.php", true);
    s.send(form);

}

function ReleaseReady(id) {

    var form = new FormData();

    form.append("Assignmentid", id);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Assignment Marks waiting for Release.');
                ApplyAlertBtn('alertokbtn', 'Assignment_submitted.php?id=' + id, 'Refresh Page', 'btn-success');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process10.php", true);
    s.send(form);

}

function ReleaseNow(id) {

    var form = new FormData();

    form.append("Assignmentid", id);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Assignment Marks waiting for Release.');
                ApplyAlertBtn('alertokbtn', 'Assignment_release.php?id=' + id, 'Refresh Page', 'btn-success');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process11.php", true);
    s.send(form);

}

function UserStatus(typeid, userid, statusid) {

    var form = new FormData();

    form.append("type", typeid);
    form.append("userid", userid);
    form.append("statusid", statusid);

    var typename = "user";
    var statusname;
    var page = "signin.php";

    if (typeid == 2) {
        typename = "Academic Officer";
        page = "Admin_manage_academic.php";
    } else if (typeid == 3) {
        typename = "Teacher";
        page = "";
    } else if (typeid == 4) {
        typename = "Student";
        page = "";
    }

    if (statusid == 2) {
        statusname = "Unblock";
    } else {
        statusname = "Block";
    }

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess(typename + ' ' + statusname + ' Success.');
                ApplyAlertBtn('alertokbtn', page, 'Refresh Page', 'btn-success');
            } else if (text == "Message could not be sent. Mailer Error: SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting") {
                AlertSuccess('Database Update Success. No Mail due to Google Third Party application Policy');
                ApplyAlertBtn('alertokbtn', page, 'Refresh Page', 'btn-success');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process12.php", true);
    s.send(form);

}

function SubmitYear(now) {

    var year = document.getElementById("dropdownin");
    var enroll = document.getElementById("enroll");

    var form = new FormData();

    form.append("year", year.value);
    form.append("enroll", enroll.value);
    form.append("yearold", now);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Students are Moved to Next Grade.');
                ApplyAlertBtn('alertnobtn', 'Admin_manage_student.php', 'Back to Main Page', 'btn-success');
            } else if (text == "S1") {
                AlertDanger('This Batch not Submitted any Assignment Yet !<br/>But Student Move to the Selected Year Successfully');
                ApplyAlertBtn('alertnobtn', 'Admin_manage_student.php', 'Back to Main Page', 'btn-secondary');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process13.php", true);
    s.send(form);

}

function NewAppointed(id) {
    var year = document.getElementById("year");
    var subject = document.getElementById("subject");

    var form = new FormData();

    form.append("year", year.value);
    form.append("subject", subject.value);
    form.append("teacherid", id);

    var s = new XMLHttpRequest();

    s.onreadystatechange = function() {
        if (s.readyState == 4) {
            var text = s.responseText;
            if (text == "Success") {
                alertDangerclose();
                AlertSuccess('Teacher Successfully Appointed.');
                ApplyAlertBtn('alertokbtn', 'Admin_manage_teacher.php', 'Refresh Page', 'btn-success');
            } else {
                AlertDanger(text);
            }
        }
    };

    s.open("POST", "control/process14.php", true);
    s.send(form);

}

var DropdownShow;

function Year() {
    var dropdownv = document.getElementById("dropdownin");
    var fill = document.getElementById("FillUp");

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text47 = r.responseText;
            DropdownShow = new bootstrap.Dropdown(document.getElementById('dropdownin'));
            fill.innerHTML = text47;
            DropdownShow.show();
        }
    }
    r.open("POST", "control/process15.php", true);
    r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    r.send("val=" + dropdownv.value);
}

function ShowAvColor(z) {
    var ItemId = document.getElementById(z);
    var Input = document.getElementById("dropdownin");
    Input.value = ItemId.value;
    DropdownShow.hide();
}

function ContactMeMsg() {
    var CuName = document.getElementById("ContactName");
    var CuEmail = document.getElementById("ContactEmail");
    var CuMessage = document.getElementById("ContactMessage");

    var t = new XMLHttpRequest();
    swal({ title: "Your Messege is on the Way", });
    t.onreadystatechange = function() {
        if (t.readyState == 4) {
            var text3 = t.responseText;
            if (text3 == "Please enter your email address") {
                swal({ title: text3, });
            }
            if (text3 == "Message has been sent.") {
                swal({ title: text3, });
                CuName.value = "";
                CuEmail.value = "";
                CuMessage.value = "";
            } else {
                swal({ title: text3, });
            }
        }
    };
    t.open("POST", "control/process16.php", true);
    t.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    t.send("Name=" + CuName.value + "&Email=" + CuEmail.value + "&Message=" + CuMessage.value);
}

function PayNowHere() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text20 = r.responseText;
            if (text20 == "ER1") {
                AlertDanger('You have no permission to do this.');
            } else if (text20 == "ER2") {
                AlertDanger('You have no need to Pay. Contact Admin');
                ApplyAlertBtn('alertnobtn', 'contact.php', 'Contact Page', 'btn-danger');
            } else {
                var Object = JSON.parse(text20);
                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    PaySuccess(Object);
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218077", // Replace your Merchant ID
                    "return_url": undefined, // Important
                    "cancel_url": undefined, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": Object["OrderId"],
                    "items": Object["item"],
                    "amount": Object["amount"],
                    "currency": "LKR",
                    "first_name": Object["name"],
                    "last_name": undefined,
                    "email": Object["email"],
                    "phone": Object["mobile"],
                    "address": Object["address"],
                    "city": Object["city"],
                    "country": "Sri Lanka",
                    "delivery_address": undefined,
                    "delivery_city": undefined,
                    "delivery_country": undefined,
                    "custom_1": Object["id"],
                    "custom_2": Object["year"]
                };

                payhere.startPayment(payment);
            };
        }
    }
    r.open("POST", "control/process20.php", true);
    r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    r.send();
}