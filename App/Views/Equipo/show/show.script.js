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
            user:[],
            question:false,
            question2:false,
            equipo:[],
            archivo:false,
            index:"",
            numero_emp:"",nombre_emp:"",puesto:"",correo:"",area:"",tipo_pc:"",no_serie:"",
            compresor:"",ofice:"",navegador:"",antivirus:"",lector_pdf:"",nx:"",master:"",
            tulip:"",
        }
    },
    methods: {

        async Loadequipos(type="")
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

        async Loadunsigned(type="")
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
                console.log(res.data);
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

        async Loadusuarios(type="")
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
                const res = await axios.post("https://internos.busman.com.mx/requisicion/Usuario/getall/" + this.page, form);
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
                        this.Loadequipos();
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
                        this.Loadequipos();
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

        async Asignar(id, user)
        {
            this.user = user;
            this.equipo = this.equipos[this.index];
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
                        this.Loadequipos();
                        this.modal2 = false;
                        this.question2 = true;
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
                        this.Loadequipos();
                        this.LoadDocuemntInfo();
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

        LoadDocuemntInfo()
        {
            this.numero_emp = this.user.numero;
            this.nombre_emp = `${this.user.Nombre}  ${this.user.Apellidos}`;
            this.correo = this.user.Correo;
            this.area = this.user.Area;
            this.nombre_equipo = this.equipo.nombre;
            this.modelo = this.equipo.modelo;
            this.marca = "DELL";
            this.sistema = this.equipo.sistema;
            this.puesto = this.user.puesto;
            this.memoria = this.equipo.memoria;
            this.procesador = this.equipo.procesador;
            this.espacio = this.equipo.almacenamiento;
        },

        GenDocument()
        {
            this.LoadDocuemntInfo();
            this.archivo = true;
            this.question2 = false;
        },

        async SaveDocument()
        {
            this.alert = true;
            this.textalert = "Creando documento";
            let form =  new FormData();
            form.append("No_Empleado", this.numero_emp);
            form.append("Nombre", this.nombre_emp);
            form.append("Puesto", this.puesto);
            form.append("Correo", this.correo);
            form.append("Area", this.area);
            form.append("Tipo", this.tipo_pc);
            form.append("Nombre_E", this.nombre_equipo);
            form.append("Marca", this.marca);
            form.append("Modelo", this.modelo);
            form.append("No_Serie", this.no_serie);
            form.append("Procesador", this.procesador);
            form.append("Memoria", this.memoria);
            form.append("Disco", this.espacio);
            form.append("Mouse", "Si");
            form.append("Teclado", "No");
            form.append("Monitor", "No");
            form.append("Cargador", "Si");
            form.append("Celular", "No");
            form.append("USB", "No");
            form.append("Sistema", this.sistema);
            form.append("Ofice", this.ofice);
            form.append("Compresor", this.compresor);
            form.append("Navegador", this.navegador);
            form.append("Antivirus", this.antivirus);
            form.append("Lector_pdf", this.lector_pdf);
            form.append("Nx", this.nx);
            form.append("Master", this.master);
            form.append("Tulip", this.tulip);
            form.append("Firma", "");
            form.append("tipo_doc", "entrega");
            form.append("token", this.token);
            form.append("method", "POST");
            try{
                const res = await axios.post("../Archivo/save", form);
                setTimeout(() => {
                    this.archivo = false;
                    this.SuccesAlert("Archivo generado con éxito");
                    this.alert = false;
                    this.OpenDocument(res.data.id);
                }, 1000);
            }
            catch(err)
            {
                this.ErrorAlert(err);
                this.alert = false;
            }
        },

        OpenDocument(id)
        {
            let configuracion_ventana = 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=700,height=650,left = 390,top = 50';
            opn = window.open("https://internos.busman.com.mx/reportes/pdf.php?formato=entrega&&id=" + id, "Orden de requisición", configuracion_ventana);
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
        this.Loadequipos();
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
                this.archivo = false;
            }
        })
    },
}).mount("#app");