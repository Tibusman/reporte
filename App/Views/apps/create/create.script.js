const app = Vue.createApp({
    data() {
        return {
            nombre: "",
            version: "",
            url: "",
            descripcion: "",
            alert: false,
            textalert: "",
            file: [],
            image: "",
        }
    },
    methods: {
        OpenFile() {
            let e = event || window.event;
            this.file = e.target.files[0];
            this.image = URL.createObjectURL(this.file);
        },

        async SaveAll() {
            try {
                if (this.Validar() === true) {
                    this.textalert = "Guardado Cambios";
                    this.alert = true;
                    let form = new FormData();
                    form.append("files", this.file);
                    form.append("app_name", this.nombre);
                    form.append("version", this.version);
                    form.append("url", this.url);
                    form.append("Descripcion", this.descripcion);
                    form.append("token", this.token);
                    form.append("method", "POST");
                    const res = await axios.post("store", form);
                    console.log(res.data);
                    if (res.data === true) {
                        setTimeout(() => {
                            this.alert = false;
                            this.SuccesAlert("Aplicación creada con éxito");
                            this.Clean();
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
            else if (this.file.length === 0) {
                this.ErrorAlert("La app necesita un icono");
                return false;
            }
            else {
                return true;
            }
        },

        Clean()
        {
            this.nombre = "";
            this.descripcion = "";
            this.version = "";
            this.url = "";
            this.image = "";
            this.file = [];
        },

        Cancel()
        {
            window.location = "show";
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
        this.token = document.getElementById("token").value;
    },
}).mount("#app");