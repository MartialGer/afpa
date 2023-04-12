document.addEventListener('DOMContentLoaded', function () {
  
    /*  IMAGE */


    const imageInput = document.getElementById("image");
    const imagePreview = document.getElementById("imagePreview");


    imageInput.addEventListener("change", function () {

        if (imageInput.files.length === 0) {
            imagePreview.src = '';
        } else {
            const selectedFile = imageInput.files[0];
            const imageUrl = URL.createObjectURL(selectedFile);
            imagePreview.src = imageUrl;
        }
    });


    /* VIDEO */
    const vidInput = document.getElementById("urlVid");
    const vidPreview = document.getElementById("vidPreview");
  
    vidInput.addEventListener("input", function () {
        let vidUrl = vidInput.value;
        if (vidUrl !== '') {
            vidPreview.classList.remove('hidden');
        }else{
            vidPreview.classList.add('hidden');
        }

        let vidID = vidUrl.replace('https://www.youtube.com/watch?v=', '');
        vidPreview.src = "https://www.youtube.com/embed/" + vidID;

    });

   /*  const annuler = document.getElementById("annuler");
    annuler.addEventListener("click", (event)=>{
        event.preventDefault();
    }); */
 
    let editor = CKEDITOR.replace( 'editor2' );

    editor.on( 'required', function( evt ) {
        editor.showNotification( 'Ce champ est requis', 'warning' );
        evt.cancel();
    } );
    
});