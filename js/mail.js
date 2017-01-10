// http://www.rapidtables.com/web/html/mailto.htm"

function envoieMail()
{
    //adresse à laquelle le mailto enverra le mail
    
    var mailCible = "service@partoutmtl.ca";
    var mailCible2 = "contact_admin@partoutmtl.ca";
    
    //on va chercher les donner à envoyer dans le mail
    
    var sujet = encodeURI(document.getElementById("mailSujet").value);
    var body = encodeURI(document.getElementById("mailBody").value);
    
    //on construit le string 
    
    //var stringFinal = "mailto:"+mailCible+","+mailCible2+"?subject=test&amp;body=test";//+body;
    var stringFinal = "mailto:name1@mail.com,name2@mail.com?subject=gazou%20le%20poo&amp;body=C'est%20%2520%20de%20la%20%20belle%20foutaise%20mon%20grand%20!!";
    
    //on ouvre une fenêtre du client de email par defaut avec toutes les infos entrés plus haut il ne reste qu'à appuyer "send"
    
    console.log("le gros string :   "+stringFinal);
    
    console.log("On envoie");
    
    window.open(stringFinal);
}