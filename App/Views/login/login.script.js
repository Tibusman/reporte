const app = Vue.createApp({
    data() {
        return {
            mail: "",
            password: "",
            token:"",
            url:"https://internos.busman.com.mx/requisicion/login",
        }
    },
    methods: {
        
        async LoginForm() {
            let e = window.event || event;
            e.preventDefault();
            if (this.mail === "") {
                this.ErrorAlert("El campo de correo esta vació");
            }
            else if (this.password === "") {
                this.ErrorAlert("El campo de contraseña esta vació");
            }
            else {
                let form = new FormData;
                form.append("Correo",this.mail);
                form.append("password", this.password);
                form.append("token", this.token);
                try {
                    const res = await axios.post(this.url, form);
                    console.log(res.data);
                    if(res.data === "Menu")
                    {
                        this.SuccesAlert("Bienvenido");
                        setTimeout(() => {
                            window.location="menu";
                        }, 1000);
                    }
                    else
                    {
                        this.ErrorAlert(res.data);
                    }
                }
                catch (err) {
                    this.ErrorAlert(err);
                }
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
    },
}).mount("#app");