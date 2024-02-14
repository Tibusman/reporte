const app = Vue.createApp({
    data() {
        return {
            id:"",
            inventario:[],
            editar:false,
            articulo:"",
            no_serie:"",
            descripcion:"",
            id_item:"",
            modal:false,
            token:"",
            options:false,
            index_item:"",
            question:false,
            modal2:false,
            page:"",
            users:[],
            search2:"",
        }
    },
    methods: {
        async LoadInventario()
        {
            try{
                const res = await axios.get("../getinventario/" + this.id);
                this.inventario = res.data;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },
        async SendData()
        {
            let e = event||window.event;
            e.preventDefault();
            let form = new FormData();
            if(this.editar === true)
            {
                form.append("id", this.id_item);
                form.append("method", "PUT");
            }
            else
            {
                form.append("method", "POST");
            }
            form.append("articulo", this.articulo);
            form.append("descripcion", this.descripcion);
            form.append("No_serie", this.no_serie);
            form.append("token", this.token);
            form.append("id_inventario", this.id);
            try{
                let res = "";
                if(this.editar !== true)
                {
                    res = await axios.post("../additeminventario", form);
                    if(res.data === true)
                    {
                        this.SuccesAlert("Articulo registrado con éxito");
                        this.LoadInventario();
                        this.modal = false;
                        this.ClearInputs();
                    }  
                    else
                    {
                        this.ErrorAlert(res.data);
                    } 
                }
                else
                {
                    res = await axios.post("../edititeminventario", form);
                    if(res.data === true)
                    {
                        this.SuccesAlert("Articulo editado con éxito");
                        this.LoadInventario();
                        this.modal = false;
                        this.ClearInputs();
                    }
                    else
                    {
                        this.ErrorAlert(res.data);
                    } 
                }
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },
        
        ClearInputs()
        {
            this.articulo = "";
            this.descripcion = "";
            this.no_serie = "";
        },
        OpenModal(type)
        {
            this.options = false;
            this.editar = type;
            this.modal = true;
            this.descripcion = this.inventario[this.index_item].descripcion;
            this.no_serie = this.inventario[this.index_item].No_serie;
            this.articulo = this.inventario[this.index_item].articulo;
        },
        OpenOptions(id, index)
        {
            this.id_item = id;
            this.index_item = index;
            this.options = true;
        },

        Question()
        {
            this.question = true;
            this.options = false;
        },
        Asign()
        {
            this.Loadusuarios();
            this.modal2 = true;
        },
        async UserAsign(id)
        {
            let form = new FormData();
            form.append("id", this.id_item);
            form.append("id_usuario", id);
            form.append("token", this.token);
            form.append("method", "PUT");
            try
            {
                const res = await axios.post("../edititeminventario", form);
                if(res.data === true)
                {
                    this.options = false;
                    this.modal2 = false;
                    this.LoadInventario();
                    this.SuccesAlert("Usuario asignado con éxito");
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
                console.log(res.data)
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

        async DeleteItem()
        {
            let form = new FormData();
            form.append("id", this.id_item);
            form.append("token", this.token);
            form.append("method", "DELETE");
            try
            {
                const res = await axios.post("../destroyitem", form);
                if(res.data === true)
                {
                    this.SuccesAlert("Item eliminado con éxito");
                    this.LoadInventario();
                    this.options = false;
                    this.question = false;
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
        this.id = window.location.toString();
        let array = this.id.split("/");
        this.id = array[ array.length - 1 ];
        this.LoadInventario();
        this.token = document.getElementById("token").value;
        window.addEventListener("keyup", (e)=>{
            if(e.key === "Escape")
            {
                this.modal = false;
                this.options = false;
                this.ClearInputs();
                this.modal2 = false;
            }
        })
    },
}).mount("#app");

