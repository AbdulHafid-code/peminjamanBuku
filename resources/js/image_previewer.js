document.addEventListener("DOMContentLoaded", () => {
    const wrapper = document.getElementById("avatarWrapper");
    const input = document.getElementById("avatarInput");
    const preview = document.getElementById("avatarPreview");
    const icon = document.getElementById("avatarIcon");
    const isRequired = wrapper.dataset.isrequired != undefined && wrapper.dataset.isrequired == "true" ? true : false;
    const defaultSrc = preview.dataset.defaultsrc;

    if(!isRequired) {
        const inputHapus = document.createElement('input');
        inputHapus.type = "hidden";
        inputHapus.value = "false";
        inputHapus.id = "inputHapus";
        inputHapus.name = "inputHapus";
        wrapper.appendChild(inputHapus);
    }

    const setIcon = (trash) => {
        icon.className = trash ? "bx bxs-trash text-white text-xl" : "bx bxs-pencil text-white text-xl";
    };

    if(preview.src != defaultSrc && isRequired != true) {
        setIcon(true);
    } else {
        setIcon(false)
    }

    wrapper.addEventListener("click", () => {
        if(preview.src != defaultSrc && isRequired != true) {
            setIcon(false);
            preview.src = defaultSrc;
            input.value = "";
            document.querySelector('#inputHapus').value = "true";
            return;
        }

        setIcon(false);
        input.click();
    });

    input.addEventListener("change", () => {
        const file = input.files[0];
        if (!file) return;
        
        preview.src = URL.createObjectURL(file);
        
        if(preview.src != defaultSrc && isRequired != true) {
            document.querySelector('#inputHapus').value = "false";
            setIcon(true);
        } else {
            setIcon(false);
        }
    });
});
