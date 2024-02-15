const app = Vue.createApp({
    data() {
        return {
            modal:false,
            signaturePad:"",
            id:"",documento:[],
            rect:"",
        }
    },
    methods: {
        async GuardarBtn()
        {
            if (this.signaturePad.isEmpty()) {
                this.ErrorAlert('La firma está vacía. Por favor, dibuja tu firma.');
            } else {
                var signatureDataURL = this.signaturePad.toDataURL();
                let form = new FormData();
                form.append("token", this.token);
                form.append("method", "PUT");
                form.append("id", this.id);
                form.append("firma", signatureDataURL);
                try
                {
                    const res = await axios.post("../firmar", form);
                    if(res.data === true)
                    {
                        setTimeout(() => {
                            this.SuccesAlert("Documento firmado con éxito");
                            this.modal = false;
                            window.location = window.location;
                        }, 1000);
                    }
                    else
                    {
                        this.ErrorAlert(res.data)
                    }
                }
                catch(err)
                {
                    this.ErrorAlert(err);
                }
            }
        },

        ChangeColor(color="black")
        {
            if(color === "black")
            {
                this.SuccesAlert("Color negro seleccionado");
                this.signaturePad.penColor = color;
            }
            else if(color === "blue")
            {
                this.SuccesAlert("Color azul seleccionado");
                this.signaturePad.penColor = color;
            }
        },

        async GetDocument(id)
        {
            try{
                const res = await axios.get("../getfile/" + id);
                console.log(res.data)
                this.documento = res.data[0];
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        CloseModal()
        {
            this.modal = false;
            this.LimpiarFirma();
        },

        OpenModal()
        {
            this.modal = true;
        },

        LimpiarFirma()
        {
            this.signaturePad.clear();
        },

        ajustarTamañoLienzo()
        {
            const ancho = window.innerWidth; 
            if(ancho <= 800)
            {
                this.canvas.width = ancho;
                console.log(ancho);
            }
        },

        ErrorAlert(mensaje)
        {
            $(function(){
                $.amaran({
                    'theme'     :'colorful',
                    'content'   :{
                    bgcolor:'#c0392b',
                    color:'#fff',
                    message:mensaje
                    },
                    'cssanimationIn'    :'shake',
                    'cssanimationOut'   :'fadeOutRight',
                    'outEffect'         :'slideRight',
                    'position'          :'bottom right'
                });
                
            });
        },

        SuccesAlert(mensaje)
        {
            $(function(){
                $.amaran({'message':mensaje})
            })
        },
    },
    mounted() {
        this.token = document.getElementById("token").value;
        this.id = document.getElementById("id").value;
        this.GetDocument(document.getElementById("id").value);
        var canvas = document.getElementById('signatureCanvas');
        this.canvas = document.getElementById('signatureCanvas');
        this.signaturePad = new SignaturePad(canvas);
        window.addEventListener("keyup", ()=>{
            this.modal = false;
            this.LimpiarFirma();
        });
        window.addEventListener('resize', this.ajustarTamañoLienzo);
        this.ajustarTamañoLienzo();
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.ajustarTamañoLienzo);
        window.removeEventListener('keyup', this.keyupHandler);
    },
}).mount("#app");