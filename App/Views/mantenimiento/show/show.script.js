const app = Vue.createApp({
    data() {
        return {
            fecha_filter:"",
            mantenimientos:[],
            page1:"",
            page2:"",
            token:"",
            modal:false,
            modal2:false,
            modal3:false,
            id:"",
            idequipo:"",
            iduser:"",
            equipos:[],
            search:"",
            indice:"",alert:false,
            textalert:"",
            nombre:"",fecha:"",iscomplete:false,
            solucion:"", modal4:false,
        }
    },
    methods: {
        async LoadMantenimientos(type="")
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
            try{
                let form = new FormData();
                form.append("search", this.fecha_filter);
                form.append("method", "GET");
                const res = await axios.post("getall/"+this.page1, form);
                console.log(res.data);
                if(res.data.length != 0 )
                {
                    this.mantenimientos = res.data;
                }
                else {
                    if(this.page1>=0)
                    {
                        this.page1 = 1;
                    }
                }
            }catch(err){
                console.log(err)
            }
        },

        OpenOptions(id, id_user, state)
        {
            if(state === "Completo")
            {
                this.iscomplete = true;
            }
            else
            {
                this.iscomplete = false;
            }
            this.iduser = id_user;
            this.id = id;
            this.modal = true;
        },

        async LoadEquipos(type="")
        {
            if(this.page2 === "")
            {
                this.page2 = 1;
            }
            else if(type == "+")
            {
                this.page2++;
            }
            else
            {
                this.page2--;
            }
            if(this.page2 === 0)
            {
                this.page2 = 1;
            }
            try{
                let form = new FormData();
                form.append("search", this.search);
                const res = await axios.post("../Equipo/getall/"+this.page2, form);
                if(res.data.length != 0 )
                {
                    this.equipos = res.data;
                }
                else {
                    if(this.page2>=0)
                    {
                        this.page2 = 1;
                    }
                }
            }catch(err){
                console.log(err)
            }
        },

        Elegir(id, index)
        {
            this.idequipo = id;
            this.indice = index;
        },

        Cambiar()
        {
            this.indice = "";
        },

        async ProgramarMantenimiento()
        {
            this.alert = true;
            this.textalert = "Creando mantenimiento";
            if(this.indice === "")
            {
                this.ErrorAlert("Debes seleccionar aun equipo")
            }
            else if(this.nombre === "")
            {
                this.ErrorAlert("Introduce un nombre en el campo")
            }
            else if(this.fecha === "")
            {
                this.ErrorAlert("Selecciona una fecha")
            }
            else
            {
                let form = new FormData();
                form.append("nombre", this.nombre);
                form.append("id_com", this.idequipo);
                form.append("id_user", this.equipos[this.indice].Id_Us);
                form.append("fecha_exp", this.fecha);
                form.append("method", "POST");
                form.append("token", this.token);
                try
                {
                    const res = await axios.post("save", form);
                    if(res.data === true)
                    {
                        setTimeout(() => {
                            this.alert = false;
                            this.modal2 = false;
                            this.CleanFields();
                            this.LoadMantenimientos();
                            this.SuccesAlert("Mantenimiento creado con éxito");
                        }, 1000);
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
            }
        },

        CleanFields()
        {
            this.nombre = "";
            this.indice = "";
            this.fecha = "";
            this.search = "";
        },

        Programar()
        {
            this.modal2 = true;
        },

        Actualizar()
        {
            this.modal2 = false;
            this.modal = false;
            this.modal3 = true;
        },

        async UpdateMante(type="")
        {
            this.alert = true;
            this.textalert = "Actualizando mantenimiento";
            let form = new FormData();
            form.append("id_man", this.id);
            form.append("iduser", this.iduser)
            form.append("Description", this.solucion);
            form.append("token", this.token);
            form.append("tipo", type); 
            form.append("method", "POST");
            try
            {
                const res = await axios.post("savemante", form);
                console.log(res.data);
                if(res.data === true)
                {
                    if(type === "Completo")
                    {
                        setTimeout(() => {
                            this.UpdateStatus(type);
                            this.SuccesAlert("Se ha finalizado el mantenimiento");
                        }, 1000);
                        
                    }
                    else
                    {
                        setTimeout(() => {
                            this.UpdateStatus(type);
                            this.SuccesAlert("Se ha actualizado el mantenimiento");
                        }, 1000);
                    }
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

        async UpdateStatus(status="")
        {
            let form = new FormData();
            form.append("estado", status);
            form.append("method", "PUT");
            form.append("token", this.token);
            form.append("id", this.id);
            try
            {
                const res = await axios.post("update", form);
                if(res.data === true)
                {
                    this.alert = false;
                    this.modal3 = false;
                    this.LoadMantenimientos("-");
                    this.solucion = "";
                }
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },
        async LoadhistorialMante()
        {
            try
            {
                const res = await axios.get("gethistorial/"+this.id);
                this.historial = res.data;
                this.modal4 = true;
                this.modal = false;
            }
            catch(err)
            {
                this.ErrorAlert(err);
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
        this.LoadMantenimientos();
        this.LoadEquipos();
        this.token = document.getElementById("token").value;
        window.addEventListener("keydown", (e)=>{
            if(e.key === "Escape")
            {
                this.modal = false;
                this.modal2 = false;
                this.modal3 = false;
                this.solucion = "";
                this.modal4 = false;
            }
        })
    },
}).mount("#app");