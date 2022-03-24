//Wizard Init
console.log(currentLanguage);
(function($) {

if (currentLanguage == "mm") {
    btnPrevious = "ရှေ့တစ်ခု";
    btnNext = "နောက်တစ်ခု";
    btnFinish = "ပြီးပါပြီ";

}
else if(currentLanguage == "jp"){
    btnPrevious = "前";
    btnNext = "次";
    btnFinish = "終了";
}
else if(currentLanguage == "cn"){
    btnPrevious = "以前的";
    btnNext = "下一个";
    btnFinish = "结束";
}
else if(currentLanguage == "de"){
    btnPrevious = "Früher";
    btnNext = "Nächste";
    btnFinish = "Ziel";
}
else if(currentLanguage == "fr"){
    btnPrevious = "Précédente";
    btnNext = "Suivante";
    btnFinish = "Terminer";
}
else{
    btnPrevious = "Previous";
    btnNext = "Next";
    btnFinish = "Finish";
}


var form = $("#stepsForm");
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "none",
    titleTemplate: '#title#',
    labels: {
            previous: btnPrevious,
            next: btnNext,
            finish: btnFinish,
            current: ''
        },
        onFinished: function(event, currentIndex) {
            var about = document.querySelector('textarea[name=description]');
            form.submit();
        }
});

})(jQuery);
