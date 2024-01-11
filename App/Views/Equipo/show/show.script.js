const app = Vue.createApp({
    data() {
        return {
            equipos:[],
            textalert:"",
            alert:false,
            page1:"",
            page:"",
            search:"",
            search2:"",
            id:"",
            marcas:[],
            nombre_equipo:"",
            modelo:"",
            sistema:"",
            espacio:"",
            memoria:"",
            procesador:"",
            marca:"",
            modal:false,
            modal2:false,
            modal3:false,
            options:false,
            token:"",
            users:[],
            question:false,
            index:"",
        }
    },
    methods: {
        async Loadequipos(type="+")
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
            let form = new FormData();
            form.append("search", this.search);
            try{
                const res = await axios.post("getall/" + this.page1, form);
                console.log(res.data)
                if(res.data.length != 0 )
                {
                    this.equipos = res.data;
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

        async Loadunsigned(type="+")
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
            let form = new FormData();
            form.append("search", this.search);
            try{
                const res = await axios.post("getallunsigned/" + this.page1, form);
                
                if(res.data.length != 0 )
                {
                    this.equipos = res.data;
                }
                else 
                {
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

        async Loadusuarios(type="+")
        {
            if(this.page === "")
            {
                this.page = 1;
            }
            else if(type == "+")
            {
                this.page++;
            }
            else
            {
                this.page--;
            }
            if(this.page === 0)
            {
                this.page = 1;
            }
            try
            {
                let form = new FormData();
                form.append("nombre", this.search2)
                const res = await axios.post("http://localhost/requisicion/Usuario/getall/" + this.page, form);
                if(res.data.length != 0 )
                {
                    this.users = res.data;
                }
                else {
                    if(this.page >= 0)
                    {
                        this.page = 1;
                    }
                }
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        async getmarca()
        {
            try
            {
                const res = await axios.get("getmarca");
                this.marcas = res.data;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        async RegistrarEquipo()
        {
            this.alert = true;
            this.textalert = "Creando el equipo";
            let form = new FormData();
            form.append("nombre", this.nombre_equipo);
            form.append("sistema", this.sistema);
            form.append("modelo", this.modelo);
            form.append("memoria", this.memoria);
            form.append("almacenamiento", this.espacio);
            form.append("procesador", this.procesador);
            form.append("id_marca", this.marca);
            form.append("method", "POST");
            form.append("token", this.token);
            try{
                const res = await axios.post("store", form);
                console.log(res.data);
                if(res.data == true)
                {
                    setTimeout(() => {
                        this.SuccesAlert("Equipo creado con éxito");
                        this.Loadequipos("-");
                        this.modal = false;
                        this.alert = false;
                    }, 1000);
                }
                else
                {
                    this.ErrorAlert(res.data);
                    his.alert = false;
                }
            }
            catch(err)
            {
                this.ErrorAlert(err);
                his.alert = false;
            }
        },

        async ActualizarEquipo()
        {
            this.alert = true;
            this.textalert = "Actualizando el equipo";
            let form = new FormData();
            form.append("nombre", this.nombre_equipo);
            form.append("sistema", this.sistema);
            form.append("modelo", this.modelo);
            form.append("memoria", this.memoria);
            form.append("almacenamiento", this.espacio);
            form.append("procesador", this.procesador);
            form.append("id_marca", this.marca);
            form.append("id", this.id);
            form.append("method", "PUT");
            form.append("token", this.token);
            try{
                const res = await axios.post("update", form);
                if(res.data == true)
                {
                    setTimeout(() => {
                        this.SuccesAlert("Equipo actualizado con éxito");
                        this.Loadequipos("-");
                        this.modal3 = false;
                        this.alert = false;
                    }, 1000);
                }
                else
                {
                    this.ErrorAlert(res.data);
                    this.alert = false;
                }
            }
            catch(err)
            {
                this.ErrorAlert(err);
                this.alert = false;
            }
        },

        async Asignar(id)
        {
            this.alert = true;
            this.textalert = "Asignando el equipo";
            let form = new FormData();
            form.append("Id_Us", id);
            form.append("id", this.id);
            form.append("method", "PUT");
            form.append("token", this.token);
            try{
                const res = await axios.post("update", form);
                if(res.data === true)
                {
                    setTimeout(() => {
                        this.alert = false;
                        this.SuccesAlert("Equipo asignado con éxito");
                        this.Loadequipos('-');
                        this.modal2 = false;
                    }, 1000);
                }
                else
                {
                    this.alert = false;
                    this.ErrorAlert(res.data);
                }
            }
            catch(err)
            {
                this.alert = false;
                this.ErrorAlert(err);
            }
        },

        async DeleteEquipo()
        {
            try{
                let form = new FormData();
                this.alert = true;
                this.textalert = "Eliminando el equipo";
                form.append("id", this.id);
                form.append("method", "DELETE");
                form.append("token", this.token);
                const res = await axios.post("delete", form);
                if(res.data === true)
                {   
                    setTimeout(() => {
                        this.alert = false;
                        this.SuccesAlert("Equipo eliminado con éxito");
                        this.question = false;
                        this.options = false;
                        this.Loadequipos('-');
                    }, 1000);
                }
                else
                {
                    this.alert = false;
                    this.ErrorAlert(res.data);
                }
            }
            catch(err)
            {
                this.alert = false;
                this.ErrorAlert(err);
            }
        },

        OpenOptions(id, index)
        {
            this.id = id;
            this.index = index;
            this.options = true;
        },

        OpenQuestion()
        {
            this.options = false;
            this.question = true;
        },

        openModal()
        {
            this.modal = true;
        },

        OpenModal2()
        {
            this.options = false;
            this.modal2 = true;
        },

        OpenModal3()
        {
            this.options = false;
            this.modal3 = true;
            this.nombre_equipo = this.equipos[this.index].nombre;
            this.sistema = this.equipos[this.index].sistema;
            this.modelo = this.equipos[this.index].modelo;
            this.espacio = this.equipos[this.index].almacenamiento;
            this.memoria = this.equipos[this.index].memoria;
            this.procesador = this.equipos[this.index].procesador;
            this.marca = this.equipos[this.index].id_marca;
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
        this.Loadequipos("-");
        this.getmarca();
        this.Loadusuarios();
        window.addEventListener("keyup", (e)=>{
            if(e.key === "Escape")
            {
                this.modal = false;
                this.options = false;
                this.modal2 = false;
                this.modal3 = false;
                this.question = false;
            }
        })
    },
}).mount("#app");