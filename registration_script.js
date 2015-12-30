//_script.js


function checkEmails()
{
     var email = document.getElementById("email").value;
     var email_check = document.getElementById("email_check").value;

     if ( email != email_check)
     {
         alert("Emails do not match!.");
         document.getElementById("email_check").focus();
         return false;
     }
     else
     {
          return true;
     }
}



function checkPasswords()
{
     var password = document.getElementById("password").value;
     var password_check = document.getElementById("password_check").value;

     if ( password != password_check)
     {
         alert("Passwords do not match!.");
         document.getElementById("password_check").focus();
         return false;
     }
     else
     {
          return true;
     }
}