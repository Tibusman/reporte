const app = Vue.createApp({
    data() {
        return {
            alert:false,
            textalert:"",
            apps:[],
        }
    },
    methods: {
        async LoadApps()
        {
            try
            {
                const res = await axios.get("getall");
                this.apps = res.data;
            }
            catch(err)
            {
                this.ErrorAlert(err);
            }
        },

        OpenCreate()
        {
            window.location='create';
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
        this.LoadApps();
    },
}).mount("#app");