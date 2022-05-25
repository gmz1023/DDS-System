const gmailMock = angular.module('gmailMock',[]);

const inboxController = function(){
  const inbox = this;

  //create model for email -- object that has properties for isChecked, isStarred, senderName, subjectTitle, emailMessage
  inbox.emails = [
      {isChecked: true, isStarred: false, isImportant: false, senderName:"Bob Wilder",subjectTitle:"Please  open",message:"Heyyyyyyyyoooooooooo"},
      {isChecked: false, isStarred: true, isImportant: false, senderName:"Billy TwoShoes",subjectTitle:"SPAM, DOn'T REAd",message:"WHAT DO YOU WANT"},
      {isChecked: false, isStarred: false, isImportant: false, senderName:"Grandmother Bo Peep", subjectTitle:"RE: Sheep",message:"Get them out of my yard, you hooligan!"},{isChecked: true, isStarred: false, isImportant: false, senderName:"Bob Wilder",subjectTitle:"Please  open",message:"Heyyyyyyyyoooooooooo"},
      {isChecked: false, isStarred: true, isImportant: false, senderName:"Billy TwoShoes",subjectTitle:"SPAM, DOn'T REAd",message:"WHAT DO YOU WANT"},
      {isChecked: false, isStarred: false, isImportant: false, senderName:"Grandmother Bo Peep", subjectTitle:"RE: Sheep",message:"Get them out of my yard, you hooligan!"},
    {isChecked: true, isStarred: false, isImportant: false, senderName:"Bob Wilder",subjectTitle:"Please  open",message:"Heyyyyyyyyoooooooooo"},
      {isChecked: false, isStarred: true, isImportant: false, senderName:"Billy TwoShoes",subjectTitle:"SPAM, DOn'T REAd",message:"WHAT DO YOU WANT"},
      {isChecked: false, isStarred: false, isImportant: false, senderName:"Grandmother Bo Peep", subjectTitle:"RE: Sheep",message:"Get them out of my yard, you hooligan!"},
    {isChecked: true, isStarred: false, isImportant: false, senderName:"Bob Wilder",subjectTitle:"Please  open",message:"Heyyyyyyyyoooooooooo"},
      {isChecked: false, isStarred: true, isImportant: false, senderName:"Billy TwoShoes",subjectTitle:"SPAM, DOn'T REAd",message:"WHAT DO YOU WANT"},
      {isChecked: false, isStarred: false, isImportant: false, senderName:"Grandmother Bo Peep", subjectTitle:"RE: Sheep",message:"Get them out of my yard, you hooligan!"},
    {isChecked: true, isStarred: false, isImportant: false, senderName:"Bob Wilder",subjectTitle:"Please  open",message:"Heyyyyyyyyoooooooooo"},
      {isChecked: false, isStarred: true, isImportant: false, senderName:"Billy TwoShoes",subjectTitle:"SPAM, DOn'T REAd",message:"WHAT DO YOU WANT"},
      {isChecked: false, isStarred: false, isImportant: false, senderName:"Grandmother Bo Peep", subjectTitle:"RE: Sheep",message:"Get them out of my yard, you hooligan!"},
    {isChecked: true, isStarred: false, isImportant: false, senderName:"Bob Wilder",subjectTitle:"Please  open",message:"Heyyyyyyyyoooooooooo"},
      {isChecked: false, isStarred: true, isImportant: false, senderName:"Billy TwoShoes",subjectTitle:"SPAM, DOn'T REAd",message:"WHAT DO YOU WANT"},
      {isChecked: false, isStarred: false, isImportant: false, senderName:"Grandmother Bo Peep", subjectTitle:"RE: Sheep",message:"Get them out of my yard, you hooligan!"},
    {isChecked: true, isStarred: false, isImportant: false, senderName:"Bob Wilder",subjectTitle:"Please  open",message:"Heyyyyyyyyoooooooooo"},
      {isChecked: false, isStarred: true, isImportant: false, senderName:"Billy TwoShoes",subjectTitle:"SPAM, DOn'T REAd",message:"WHAT DO YOU WANT"},
      {isChecked: false, isStarred: false, isImportant: false, senderName:"Grandmother Bo Peep", subjectTitle:"RE: Sheep",message:"Get them out of my yard, you hooligan!"}
  ];  
}

gmailMock.controller('inboxController',inboxController);


/*testing out structuring different controllers and modules in the same file bc of codepen's Pen file structure

var gmailMock = angular.module('gmailMock', [])

var testController = function() {
  var test = this;
  test.message = 'whoop'
};

var test2Controller = function(){
  var test2 = this;
  test2.message = 'nope, yup, maybe'
};

gmailMock.controller("testController",testController)
gmailMock.controller("test2Controller",test2Controller)

*/