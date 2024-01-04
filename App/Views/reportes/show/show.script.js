const app = Vue.createApp({
    data() {
        return {
            reportes:[],
            page1:"",
            search:"",
            modal:false,
            titulo:"",
            descripcion:"",
            tipo:"",
            token:"",
            modal2:false,
            modal3:false,
            idreport:0,
            producto_detail:[],
            modal4:false, modal5:false,
            title_text:"", showinfo:"",
            description_text:"",
            solucion:"",
            alert:false,
            textalert:"",
        }
    },
    methods: {
        async LoadReportes(type="+")
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
                form.append("search", this.search);
                form.append("method", "GET");
                const res = await axios.post("getreportes/"+this.page1, form);
                console.log(res.data);
                if(res.data.length != 0 )
                {
                    this.reportes = res.data;
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
        
        CleanForm()
        {
            this.modal = false;
            this.titulo="";
            this.descripcion ="";
            this.tipo = "";
        },

        OpenModal()
        {
            this.modal = true;
        },

        OpenOptions(id)
        {
            this.showinfo = "";
            this.modal2 = true;
            this.id = id;
        },

        OpenInfo(index)
        {
            if(index === this.showinfo)
            {
                this.showinfo = "";
            }
            else
            {
                this.showinfo = index;
            }
        },

        async CreateReport(e)
        {
            e.preventDefault();
            this.alert = true;
            this.textalert = "Creando reporte";
            let form = new FormData();
            form.append("Titulo", this.titulo);
            form.append("Descripcion", this.descripcion);
            form.append("Tipo_r", this.tipo);
            form.append("token", this.token);
            form.append("method", "POST");
            try{
                const res = await axios.post("store", form);
                console.log(res.data);
                if(res.data ===  true)
                {
                    setTimeout(() => {
                        this.alert = false;
                        this.SuccesAlert("Reporte creado con éxito");
                        this.CleanForm();
                        this.LoadReportes('-');
                    }, 1000);
                }
                else
                {
                    this.ErrorAlert(res.data)
                }
            }
            catch(err)
            {
                console.log(err);
            }
        },

        OpenModal3()
        {
            this.modal3 = true;
        },

        async DeleteReporte(){
            this.alert = true;
            this.textalert = "Eliminando reporte";
            let form = new FormData();
            form.append("id", this.id);
            form.append("method", "DELETE");
            form.append("token", this.token);
            try{
                const res = await axios.post("delete", form);
                if(res.data === true)
                {
                    setTimeout(() => {
                        this.modal3 = false;
                        this.modal2 = false;
                        this.LoadReportes('-');
                        this.SuccesAlert("Reporte eliminado con éxito");
                        this.alert = false;
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

        async LoadReporteDetail()
        {
            try{
                const res = await axios.get("loadreportedetail/"+this.id);
                if(res.data.length > 0)
                {
                    console.log(res.data)
                    this.producto_detail = res.data;
                    this.title_text = res.data[0].Titulo;
                    this.description_text = res.data[0].Descripcion;
                setTimeout(() => {
                    this.modal4 = true;
                }, 500);
                }
                else
                {
                    this.ErrorAlert("No se encontró detalles del producto, agrega una actualización");
                }
            } 
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        OpenSupport()
        {
            this.modal2 = false;
            this.modal5 = true;
        },

        async SendSupport(type="")
        {
            let form = new FormData();
            form.append("token", this.token);
            form.append("Solucion", this.solucion);
            form.append("id_rep", this.id);
            form.append("method", "POST");
            try{
                const res = await axios.post("postsolution", form);
                if(res.data === true)
                {
                    if(type === "Proceso")
                    {
                        this.UpdateReporte(type);
                        this.SuccesAlert("Se ha actualizado el soporte");
                    }
                    else{
                        this.UpdateReporte(type);
                        this.SuccesAlert("Se ha finalizado el soporte");
                    }
                    
                }
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        async UpdateReporte(type)
        {
            this.alert = true;
            this.textalert = "Actualizando reporte";
            let form = new FormData();
            form.append("Estado", type);
            form.append("id", this.id);
            form.append("token", this.token);
            form.append("method", "PUT");
            try
            {
                const res = await axios.post("update", form);
                console.log(res.data)
                if(res.data === true)
                {
                    setTimeout(() => {
                        this.modal5 = false;
                        this.LoadReportes('-');
                        this.solucion="";
                        this.alert = false;
                        this.SuccesAlert("Reporte actualizado con éxito");
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
        window.addEventListener("keyup", (e)=>{
            if(e.key === "Escape")
            {
                this.CleanForm();
                this.modal2 = false;
                this.modal3 = false;
                this.modal4 = false;
                this.modal5 = false;
                this.solucion = "";
            }
        })
        this.token = document.getElementById("token").value;
        this.LoadReportes();
    },
}).mount("#app");