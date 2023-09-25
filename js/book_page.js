let addToListButton = document.querySelector('.action__ul');
console.log(addToListButton);

document.addEventListener("click", function (event) {
   if (event.target.closest('.action__ul')) {
      addToListButton.classList.toggle('_active');
   }
   if (!event.target.closest('.action__ul')) {
      addToListButton.classList.toggle('_active');
      console.log('2');
   }
})

