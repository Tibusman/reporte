const app = Vue.createApp({
    data() {
        return {
            backs:[],
            alert:false,
            textalert:"",
            modal:false,
            tooling:"",pi:"",finanzas:"",facturacion:"",
            finanzaspi:"",facturacionpi:"",rh:"", compras:"",
            calidad:"",sgc:"",ti:"",i4_0:"",total:"",comentarios:"",
            modal2:false,id:"",respaldo:[],modal3:false,page1:"",fechafilter:""
        }
    },

    methods: {
        async LoadBackup(type="+")
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
                form.append("fecha", this.fechafilter);
                const res = await axios.post("getall/"+this.page1, form);
                if(res.data.length != 0 )
                {
                    this.backs = res.data;
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

        OpenModal()
        {
            this.modal = true;
        },

        async CrearBackup()
        {
            if(this.ValidarCampos()===true)
            {
                let form = new FormData();
                form.append("TI", this.ti);
                form.append("Manufactura", this.tooling);
                form.append("Calidad", this.calidad);
                form.append("Finanzas", this.finanzas);
                form.append("RH", this.rh);
                form.append("Compras", this.compras);
                form.append("I4_0", this.i4_0);
                form.append("FinanzasPI", this.finanzaspi);
                form.append("SGC", this.sgc);
                form.append("FacturacionPI", this.facturacionpi);
                form.append("Facturacion", this.facturacion);
                form.append("PI", this.pi);
                form.append("Almacenamiento", this.total);
                form.append("Comentarios", this.comentarios);
                form.append("method", "POST");
                form.append("token", this.token);
                try{
                    const res = await axios.post("save", form);
                    console.log(res.data)
                    if(res.data === true)
                    {
                        this.SuccesAlert("Respaldo creado con éxito");
                        this.LoadBackup('-');
                        this.modal = false;
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

        ValidarCampos()
        {
            if(this.tooling === "")
            {
                this.ErrorAlert("El campo de Tooling no puede estar vació");
                return false;
            }
            else if(this.pi === "")
            {
                this.ErrorAlert("El campo de PI no puede estar vació");
                return false;
            }
            else if(this.finanzas === "")
            {
                this.ErrorAlert("El campo de Finanzas no puede estar vació");
                return false;
            }
            else if(this.facturacion === "")
            {
                this.ErrorAlert("El campo de Facturación no puede estar vació");
                return false;
            }
            else if(this.finanzaspi === "")
            {
                this.ErrorAlert("El campo de Finanzas PI no puede estar vació");
                return false;
            }
            else if(this.facturacionpi === "")
            {
                this.ErrorAlert("El campo de Facturación PI no puede estar vació");
                return false;
            }
            else if(this.rh === "")
            {
                this.ErrorAlert("El campo de RH no puede estar vació");
                return false;
            }
            else if(this.compras === "")
            {
                this.ErrorAlert("El campo de compras no puede estar vació");
                return false;
            }
            else if(this.calidad === "")
            {
                this.ErrorAlert("El campo de Calidad no puede estar vació");
                return false;
            }
            else if(this.sgc === "")
            {
                this.ErrorAlert("El campo de SGC no puede estar vació");
                return false;
            }
            else if(this.ti === "")
            {
                this.ErrorAlert("El campo de TI no puede estar vació");
                return false;
            }
            else if(this.i4_0 === "")
            {
                this.ErrorAlert("El campo de Industria no puede estar vació");
                return false;
            }
            else if(this.total === "")
            {
                this.ErrorAlert("El campo de Almacenamiento no puede estar vació");
                return false;
            }
            else if(this.comentarios === "")
            {
                this.ErrorAlert("El campo de comentarios no puede estar vació");
                return false;
            }
            else
            {
                return true;
            }
        },

        OpenOptions(id)
        {
            this.id = id;
            this.modal2 = true;
        },

        async LoadRespaldo()
        {
            try{
                const res = await axios.get("getrespaldo/"+this.id);
                console.log(res.data)
                this.respaldo = res.data[0];
                this.modal3 = true;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        async Firmar()
        {
            try
            {
                let form = new FormData();
                form.append("Firma", "https://internos.busman.com.mx/reportes/App/public/img/firma.png");
                form.append("id", this.id);
                form.append("method", "PUT");
                form.append("token", this.token);
                const res = await axios.post("update", form);
                if(res.data === true)
                {
                    this.SuccesAlert("Respaldo firmado con éxito");
                    this.modal2 = false;
                    this.LoadBackup('-');
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
        this.LoadBackup();
        this.token = document.getElementById("token").value
        window.addEventListener("keyup", (e)=>{
            if(e.key === "Escape")
            {
                this.modal = false;
                this.modal2 = false;
                this.modal3 = false;
            }
        })
    },
}).mount("#app");