const app = Vue.createApp({
    data() {
        return {
            alert:"",
            titulo:"",
            descripcion:"",
            modal:false,
            inventarios:[],
            token:"",
            id_in:"",
            options:false,
            question:false,
            index_in:"",
            edit:false,
        }
    },
    methods: {
        async RegisterInventario()
        {
            let e = event || window.event;
            e.preventDefault();
            if(this.titulo === "")
            {
                this.ErrorAlert("El titulo es obligatorio");
            }
            else if(this.descripcion === "")
            {
                this.ErrorAlert("la descripción es obligatoria");
            }
            else
            {
                let form = new FormData();
                form.append("titulo", this.titulo)
                form.append("descripcion", this.descripcion);
                form.append("token", this.token);
                if(this.edit === true)
                {
                    form.append("method", "PUT");
                    form.append("id", this.id_in);
                }
                else
                {
                    form.append("method", "POST");
                }
                try{
                    let res = "";
                    if(this.edit === true)
                    {
                        this.titulo = "";
                        this.descripcion = "";
                        res = await axios.post("update", form);
                    }
                    else
                    {
                        res = await axios.post("store", form);
                    }
                    if(res.data === true)
                    {
                        this.SuccesAlert("Inventario creado con éxito");
                        this.modal = false;
                        this.getall();
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

        async getall()
        {
            try{
                const res = await axios.get("getall");
                console.log(res.data)
                this.inventarios = res.data;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        OpenOptions(id, index)
        {
            this.index_in = index;
            this.id_in = id;
            this.options = true;
        },

        OpenModal(edit)
        {
            this.edit = edit;
            if(edit == true)
            {
                this.titulo = this.inventarios[this.index_in].titulo;
                this.descripcion = this.inventarios[this.index_in].descripcion;
            }
            this.options = false;
            this.modal = true;
        },
        Goto(id){
            window.location="watch/"+id;
        },
        Question()
        {
            this.question = true;
        },

        async DeleteInventory()
        {
            try{
                let form = new FormData();
                form.append("token", this.token);
                form.append("method", "DELETE");
                form.append("id", this.id_in);
                const res = await axios.post("destroy", form);
                if(res.data === true)
                {
                    this.options = false;
                    this.question == false;
                    this.SuccesAlert("Inventario eliminado con éxito");
                    this.getall();
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
        window.addEventListener("keyup", (e)=>{
            if(e.key === "Escape")
            {
                this.titulo = "";
                this.descripcion = "";
                this.modal = false;
                this.options = false;
                this.question = false;
            }
        });
        this.getall();
        this.token = document.getElementById("token").value;
    },
}).mount("#app");
