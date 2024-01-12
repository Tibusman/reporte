const app = Vue.createApp({
    data() {
        return {
            user_cant:0,
            rep_cant:0,
            mant_cant:0,
            resp_cant:0,
            users:[],
            page1:"",
            page:"",
            search:"",
            backs:[],
            fechafilter:"",
        }
    },
    methods: {
        async LoadUsers()
        {
            try{
                const res = await axios.get("http://localhost/requisicion/Usuario/countuser");
                this.user_cant = res.data[0].cuenta;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        async Loadreportes()
        {
            try
            {
                const res = await axios.get("Reporte/getcont");
                this.rep_cant = res.data[0].cuenta;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        async Loadmantenimiento()
        {
            try
            {
                const res = await axios.get("Mantenimiento/getcont");
                this.mant_cant = res.data[0].cuenta;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        async LoadRespaldos()
        {
            try
            {
                const res = await axios.get("Backup/getcont");
                this.resp_cant = res.data[0].cantidad;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

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

        async LoadBackup(type="+")
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
                form.append("fecha", this.fechafilter);
                const res = await axios.post("Backup/getall/"+this.page, form);
                if(res.data.length != 0 )
                {
                    this.backs = res.data;
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
        this.LoadUsers();
        this.Loadreportes();
        this.Loadmantenimiento();
        this.LoadRespaldos();
        this.CargarUsuarios();
        this.LoadBackup();
    },
}).mount("#app");