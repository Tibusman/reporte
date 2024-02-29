const app = Vue.createApp({
    data() {
        return {
            alert:false,
            textalert:"",
            image:"",
            nombre: "",
            version: "",
            url: "",
            descripcion: "",
            file: [],
            modal:false,
        }
    },
    methods: {
        async LoadDatos()
        {
            try
            {   
                const res = await axios.get("../getall/"+this.id);
                this.nombre = res.data[0].app_name;
                this.version = res.data[0].version;
                this.image = res.data[0].icon;
                this.url = res.data[0].url;
                this.descripcion = res.data[0].Descripcion;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        OpenFile() {
            let e = event || window.event;
            this.file = e.target.files[0];
            this.image = URL.createObjectURL(this.file);
        },

        async UpdateDatos() {
            try {
                if (this.Validar() === true) {
                    this.textalert = "Guardado Cambios";
                    this.alert = true;
                    let form = new FormData();
                    form.append("id", this.id);
                    form.append("files", this.file);
                    form.append("app_name", this.nombre);
                    form.append("version", this.version);
                    form.append("url", this.url);
                    form.append("Descripcion", this.descripcion);
                    form.append("token", this.token);
                    form.append("method", "PUT");
                    const res = await axios.post("../update", form);
                    console.log(res.data);
                    if (res.data === true) {
                        setTimeout(() => {
                            this.alert = false;
                            this.SuccesAlert("Aplicación actualizada con éxito");
                        }, 1000);
                    }
                    else {
                        this.alert = false;
                        this.ErrorAlert(res.data);
                    }
                }
            }
            catch (err) {
                this.alert = false;
                this.ErrorAlert(err);
            }
        },

        Validar() {
            if (this.nombre === "") {
                this.ErrorAlert("La app necesita un nombre");
                return false;
            }
            else if (this.version === "") {
                this.ErrorAlert("La app necesita una version");
                return false;
            }
            else if (this.url === "") {
                this.ErrorAlert("La app necesita un url");
                return false;
            }
            else if (this.descripcion === "") {
                this.ErrorAlert("La app necesita una descripción");
                return false;
            }
            else {
                return true;
            }
        },


        Cancel()
        {
            window.location = "../show";
        },
        OpenModal()
        {
            this.modal = true;
        },
        async Delete()
        {
            try
            {
                let form = new FormData();
                form.append("id", this.id);
                form.append("token", this.token);
                form.append("method", "DELETE");
                form.append("filename", this.image);
                const res = await axios.post("../delete", form);
                if(res.data === true)
                {
                    this.Cancel();
                }
                else
                {
                    this.ErrorAlert(res.data);
                }
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        ErrorAlert(mensaje) {
            $(function () {
                $.amaran({
                    'theme': 'colorful',
                    'content': {
                        bgcolor: '#c0392b',
                        color: '#fff',
                        message: mensaje
                    },
                    'cssanimationIn': 'shake',
                    'cssanimationOut': 'fadeOutRight',
                    'outEffect': 'slideRight',
                    'position': 'bottom right'
                });

            });
        },

        SuccesAlert(mensaje) {
            $(function () {
                $.amaran({ 'message': mensaje })
            })
        },
    },
    mounted() {
        this.id = document.getElementById("id").value;
        this.token = document.getElementById("token").value;
        this.LoadDatos();
    },
}).mount("#app");