
document.addEventListener("DOMContentLoaded", function(event) {
    const imgInp = document.getElementById('imgInp');

    imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) { 
      preview.src = URL.createObjectURL(file)
    }
   
  }
  
});