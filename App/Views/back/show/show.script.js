const app = Vue.createApp({
    data() {
        return {
            backs:[],
            alert:false,
            textalert:""
        }
    },
    methods: {
        async LoadBackup()
        {
            try
            {
                const res = await axios.get("getall");
                this.backs = res.data;
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
    },
}).mount("#app");