const app = Vue.createApp({
    data() {
        return {
            alert:false,
            textalert:"",
            usuarios:[],
            page1:"",
            users:[],
            search:"",
            idperfil:"",
            modal:false,
            modal2:false,
            rol:"",
        }
    },
    methods: {

        async CargarUsuarios(type="+")
        {
            if(this.page1 === "")
            {
                this.page1 = 1;
            }
            else if(type == "+")
            {
                this.page1++;
            }
            else
            {
                this.page1--;
            }
            if(this.page1 === 0)
            {
                this.page1 = 1;
            }
            try
            {
                let form = new FormData();
                form.append("nombre", this.search)
                const res = await axios.post("http://localhost/requisicion/Usuario/getall/"+this.page1, form);
                if(res.data.length != 0 )
                {
                    this.users = res.data;
                    console.log(res.data);
                }
                else {
                    if(this.page1 >= 0)
                    {
                        this.page1 = 1;
                    }
                }
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        ChangeView()
        {
            window.location = "../../requisicion/Usuario/show";
        },

        OpenOptions(id)
        {
            this.idperfil = id;
            this.modal = true;
        },

        OpenAsignar()
        {
            this.modal = false;
            this.modal2 = true;
        },

        async AsignarRol()
        {
            let form = new FormData();
            form.append("id_user", this.idperfil);
            form.append("id_rol", this.rol);
            form.append("method", "POST");
            form.append("token", this.token);
            try{
                const res = await axios.post("asignar", form);
                console.log(res.data)
                if(res.data === true)
                {
                    this.SuccesAlert("Rol asignado con éxito");
                    this.modal2 = false;
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

        GotoEdit()
        {
            window.location = "../../requisicion/Usuario/profile/"+this.idperfil;
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
        window.addEventListener("keyup", (e)=>{
            this.modal = false;
        })
        this.CargarUsuarios();
    },
}).mount("#app");