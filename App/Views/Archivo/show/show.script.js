const app = Vue.createApp({
    data() {
        return {
            alert: false,
            textalert: "",
            page: "",
            search: "",
            page: "",
            archivos: [],
            opciones: false,
            numero_emp: "", nombre_emp: "", puesto: "", correo: "", area: "", tipo_pc: "Laptop", no_serie: "",
            compresor: "", ofice: "", navegador: "", antivirus: "", lector_pdf: "", nx: "No", master: "No",
            tulip: "No", usb: "No", mouse: "No", teclado: "No", monitor: "No", cargador: "No", celular: "No",
            nombre_equipo: "",
            modelo: "",
            sistema: "",
            espacio: "",
            memoria: "",
            procesador: "",
            marca: "", users: [],
            page: "",
            search2: "",
            modaluser: "",
            equipo: [],
            formato: false,
            opciones: false,
            token: "",
            id: "",
            modalformat: false,
            tipo_formato: "",
            tipo_document: "", edit: false,
            indice: "", formato2: false, form_type: "",
            firma:"",
        }
    },
    methods: {

        async GetAll(type = "") {
            if (this.page === "") {
                this.page = 1;
            }
            else if (type == "+") {
                this.page++;
            }
            else {
                this.page--;
            }
            if (this.page === 0) {
                this.page = 1;
            }
            try {
                let form = new FormData();
                form.append("search", this.search);
                const res = await axios.post("getall/" + this.page, form);
                if (res.data.length != 0) {
                    this.archivos = res.data;
                }
                else {
                    if (this.page >= 0) {
                        this.page = 1;
                    }
                }
            } catch (err) {
                this.ErrorAlert(err)
            }
        },

        OpenOpciones(id, tipo, index, firma) {
            this.firma = firma;
            this.indice = index;
            this.tipo_document = tipo;
            this.id = id;
            this.opciones = true;
        },

        async Loadusuarios(type = "") {
            if (this.page === "") {
                this.page = 1;
            }
            else if (type == "+") {
                this.page++;
            }
            else {
                this.page--;
            }
            if (this.page === 0) {
                this.page = 1;
            }
            try {
                let form = new FormData();
                form.append("nombre", this.search2)
                const res = await axios.post("https://internos.busman.com.mx/requisicion/Usuario/getall/" + this.page, form);
                console.log(res.data);
                if (res.data.length != 0) {
                    this.users = res.data;
                }
                else {
                    if (this.page >= 0) {
                        this.page = 1;
                    }
                }
            }
            catch (err) {
                this.ErrorAlert(err);
            }
        },

        SelectUser(index) {
            this.nombre_emp = `${this.users[index].Nombre} ${this.users[index].Apellidos}`;
            this.numero_emp = this.users[index].numero;
            this.puesto = this.users[index].puesto;
            this.correo = this.users[index].Correo;
            this.area = this.users[index].Area;
            if (this.form_type === 1) {
                this.LoadEquipoUser(this.users[index].id);
            }
            this.modaluser = false;
        },

        async LoadEquipoUser(id) {
            try {
                const res = await axios.get("../Equipo/getbyuser/" + id);
                this.equipo = res.data[0];
                this.nombre_equipo = this.equipo.nombre;
                this.modelo = this.equipo.modelo;
                this.sistema = this.equipo.sistema;
                this.procesador = this.equipo.procesador;
                this.memoria = this.equipo.memoria;
                this.espacio = this.equipo.almacenamiento;
                this.marca = this.equipo.nombre_marca;
            }
            catch (err) {
                this.ErrorAlert(err);
            }
        },

        Verificar() {
            if (this.numero_emp === "") {
                this.ErrorAlert("El numero de empleado es obligatorio");
                return false;
            } else if (this.nombre_emp === "") {
                this.ErrorAlert("El nombre del empleado es obligatorio");
                return false;
            } else if (this.puesto === "") {
                this.ErrorAlert("El puesto del empleado es obligatorio");
                return false;
            } else if (this.correo === "") {
                this.ErrorAlert("El correo del empleado es obligatorio");
                return false;
            } else if (this.area === "") {
                this.ErrorAlert("El area del empleado es obligatorio");
                return false;
            } else if (this.tipo_pc === "") {
                this.ErrorAlert("El tipo del equipo es obligatorio");
                return false;
            } else if (this.no_serie === "") {
                this.ErrorAlert("El Numero de serie del equipo es obligatorio");
                return false;
            } else if (this.compresor === "") {
                this.ErrorAlert("El compresor del equipo es obligatorio");
                return false;
            } else if (this.ofice === "") {
                this.ErrorAlert("El software de ofimática del equipo es obligatorio");
                return false;
            } else if (this.navegador === "") {
                this.ErrorAlert("El Navegador del equipo es obligatorio");
                return false;
            } else if (this.antivirus === "") {
                this.ErrorAlert("El antivirus del equipo es obligatorio");
                return false;
            } else if (this.lector_pdf === "") {
                this.ErrorAlert("El lector de pdf del equipo es obligatorio");
                return false;
            }
            else {
                return true;
            }
        },

        async SaveDocument() {
            this.alert = true;
            this.textalert = "Creando documento";
            if (this.Verificar() === true) {
                let form = new FormData();
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
                form.append("Mouse", this.mouse);
                form.append("Teclado", this.teclado);
                form.append("Monitor", this.monitor);
                form.append("Cargador", this.cargador);
                form.append("Celular", this.celular);
                form.append("USB", this.usb);
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
                form.append("tipo_doc", this.tipo_formato);
                form.append("token", this.token);
                form.append("method", "POST");
                try {
                    const res = await axios.post("../Archivo/save", form);
                    console.log(res.data);
                    setTimeout(() => {
                        this.formato = false;
                        this.SuccesAlert("Archivo generado con éxito");
                        this.alert = false;
                        this.CleanData();
                        this.GetAll();
                    }, 1000);
                }
                catch (err) {
                    this.ErrorAlert(err);
                    this.alert = false;
                }
            }
            else {
                this.alert = false;
            }
        },

        async SaveDocument2() {
            this.alert = true;
            this.textalert = "Creando documento";

            let form = new FormData();
            form.append("No_Empleado", this.numero_emp);
            form.append("Nombre", this.nombre_emp);
            form.append("Puesto", this.puesto);
            form.append("Correo", this.correo);
            form.append("Area", this.area);
            form.append("Nombre_E", this.nombre_equipo);
            form.append("Sistema", this.sistema);
            form.append("No_Serie", this.no_serie);
            form.append("Marca", this.marca);
            form.append("Modelo", this.modelo);
            form.append("Tipo", this.tipo_pc);
            form.append("Procesador", "NA");
            form.append("Memoria", "NA");
            form.append("Disco", "NA");
            form.append("Mouse", "NA");
            form.append("Teclado", "No");
            form.append("Monitor", "No");
            form.append("Cargador", "No");
            form.append("Celular", "NA");
            form.append("USB", "No");
            form.append("Ofice", "No");
            form.append("Compresor", "NA");
            form.append("Navegador", "NA");
            form.append("Antivirus", "NA");
            form.append("Lector_pdf", "NA");
            form.append("Nx", "No");
            form.append("Master", "No");
            form.append("Tulip", "No");
            form.append("Firma", "");
            form.append("tipo_doc", this.tipo_formato);
            form.append("token", this.token);
            form.append("method", "POST");
            try {
                const res = await axios.post("../Archivo/save", form);
                console.log(res.data);
                setTimeout(() => {
                    this.formato = false;
                    this.SuccesAlert("Archivo generado con éxito");
                    this.alert = false;
                    this.CleanData();
                    this.GetAll();
                }, 1000);
            }
            catch (err) {
                this.ErrorAlert(err);
                this.alert = false;
            }

        },

        Duplicar() {
            if (this.tipo_document === "entrega" || this.tipo_document === "regreso" || this.tipo_document === "salida") {
                this.opciones = false;
                this.LoadEntrega();
            }
            else
            {
                this.opciones = false;
                this.LoadEntrega2();
            }
        },

        OpenDocument() {
            let configuracion_ventana = 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=700,height=650,left = 390,top = 50';
            opn = window.open("https://internos.busman.com.mx/reportes/pdf.php?formato=" + this.tipo_document + "&&id=" + this.id, "Orden de requisición", configuracion_ventana);
        },

        CleanData() {
            this.equipo = [];
            this.numero_emp = "";
            this.nombre_emp = "";
            this.puesto = "";
            this.correo = "";
            this.area = "";
            this.tipo_pc = "Laptop";
            this.nombre_equipo = "";
            this.marca = "";
            this.modelo = "";
            this.no_serie = "";
            this.procesador = "";
            this.memoria = "";
            this.espacio = "";
            this.mouse = "No";
            this.teclado = "No";
            this.monitor = "No";
            this.cargador = "No";
            this.celular = "No";
            this.usb = "No";
            this.sistema = "";
            this.ofice = "No";
            this.compresor = "";
            this.navegador = "";
            this.antivirus = "";
            this.lector_pdf = "";
            this.nx = "No";
            this.master = "No";
            this.tulip = "No";
            this.edit = false;
        },

        OpenEdit() {
            this.opciones = false;
            this.edit = true;
            if(this.tipo_document === "accesorio")
            {
                
                this.LoadEntrega2();
            }
            else{
                this.LoadEntrega();
            }
        },

        OpenFormat2() {
            this.form_type = 2;
            this.formato2 = true;
            this.modalformat = false;
        },

        async EditarDocumento() {
            this.alert = true;
            this.textalert = "Editando documento";
            if (this.Verificar() === true) {
                let form = new FormData();
                form.append("id", this.id);
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
                form.append("Mouse", this.mouse);
                form.append("Teclado", this.teclado);
                form.append("Monitor", this.monitor);
                form.append("Cargador", this.cargador);
                form.append("Celular", this.celular);
                form.append("USB", this.usb);
                form.append("Sistema", this.sistema);
                form.append("Ofice", this.ofice);
                form.append("Compresor", this.compresor);
                form.append("Navegador", this.navegador);
                form.append("Antivirus", this.antivirus);
                form.append("Lector_pdf", this.lector_pdf);
                form.append("Nx", this.nx);
                form.append("Master", this.master);
                form.append("Tulip", this.tulip);
                form.append("tipo_doc", this.tipo_formato);
                form.append("token", this.token);
                form.append("method", "PUT");
                try {
                    const res = await axios.post("../Archivo/update", form);
                    console.log(res.data);
                    setTimeout(() => {
                        this.formato = false;
                        this.SuccesAlert("Archivo actualizado con éxito");
                        this.alert = false;
                        this.CleanData();
                        this.GetAll();
                    }, 1000);
                }
                catch (err) {
                    this.ErrorAlert(err);
                    this.alert = false;
                }
            }
            else {
                this.alert = false;
            }
        },

        async EditarDocumento2()
        {
            this.alert = true;
            this.textalert = "Modificando documento";

            let form = new FormData();
            form.append("No_Empleado", this.numero_emp);
            form.append("Nombre", this.nombre_emp);
            form.append("Puesto", this.puesto);
            form.append("Correo", this.correo);
            form.append("Area", this.area);
            form.append("Nombre_E", this.nombre_equipo);
            form.append("Sistema", this.sistema);
            form.append("No_Serie", this.no_serie);
            form.append("Marca", this.marca);
            form.append("Modelo", this.modelo);
            form.append("Tipo", this.tipo_pc);
            form.append("Procesador", "NA");
            form.append("Memoria", "NA");
            form.append("Disco", "NA");
            form.append("Mouse", "NA");
            form.append("Teclado", "No");
            form.append("Monitor", "No");
            form.append("Cargador", "No");
            form.append("Celular", "NA");
            form.append("USB", "No");
            form.append("Ofice", "No");
            form.append("Compresor", "NA");
            form.append("Navegador", "NA");
            form.append("Antivirus", "NA");
            form.append("Lector_pdf", "NA");
            form.append("Nx", "No");
            form.append("Master", "No");
            form.append("Tulip", "No");
            form.append("Firma", "");
            form.append("tipo_doc", "accesorio");
            form.append("token", this.token);
            form.append("id", this.id);
            form.append("method", "PUT");
            try {
                const res = await axios.post("../Archivo/update", form);
                console.log(res.data);
                if(res.data === true)
                {
                    setTimeout(() => {
                        this.formato2 = false;
                        this.SuccesAlert("Archivo generado con éxito");
                        this.alert = false;
                        this.CleanData();
                        this.GetAll();
                    }, 1000);
                }
                else
                {
                    this.ErrorAlert(res.data)
                    this.alert = false;
                }
            }
            catch (err) {
                this.ErrorAlert(err);
                this.alert = false;
            }
        },

        async DeleteDocument() {
            let form = new FormData();
            form.append("id", this.id);
            form.append("method", "DELETE");
            form.append("token", this.token);
            try {
                const res = await axios.post("delete", form);
                if (res.data === true) {
                    this.GetAll();
                    this.opciones = false;
                    this.SuccesAlert("Documento eliminado con éxito");
                }
                else {
                    this.ErrorAlert(res.data);
                }
            }
            catch (err) {
                this.ErrorAlert(err);
            }
        },

        LoadEntrega() {
            this.formato = true;
            this.nombre_emp = this.archivos[this.indice].Nombre;
            this.numero_emp = this.archivos[this.indice].No_Empleado;
            this.puesto = this.archivos[this.indice].Puesto;
            this.correo = this.archivos[this.indice].Correo;
            this.area = this.archivos[this.indice].Area;
            this.tipo_pc = this.archivos[this.indice].Tipo;
            this.nombre_equipo = this.archivos[this.indice].Nombre_E;
            this.marca = this.archivos[this.indice].Marca;
            this.modelo = this.archivos[this.indice].Modelo;
            this.no_serie = this.archivos[this.indice].No_Serie;
            this.procesador = this.archivos[this.indice].Procesador;
            this.memoria = this.archivos[this.indice].Memoria;
            this.espacio = this.archivos[this.indice].Disco;
            this.teclado = this.archivos[this.indice].Teclado;
            this.monitor = this.archivos[this.indice].Monitor;
            this.cargador = this.archivos[this.indice].Cargador;
            this.celular = this.archivos[this.indice].Celular;
            this.usb = this.archivos[this.indice].USB;
            this.sistema = this.archivos[this.indice].Sistema;
            this.ofice = this.archivos[this.indice].Ofice;
            this.compresor = this.archivos[this.indice].Compresor;
            this.navegador = this.archivos[this.indice].Navegador;
            this.antivirus = this.archivos[this.indice].Antivirus;
            this.lector_pdf = this.archivos[this.indice].Lector_pdf;
            this.nx = this.archivos[this.indice].Nx;
            this.master = this.archivos[this.indice].Master;
            this.Tulip = this.archivos[this.indice].Tulip;
            this.tipo_formato = this.archivos[this.indice].tipo_doc;
        },

        LoadEntrega2(){
            this.formato2 = true;
            this.nombre_emp = this.archivos[this.indice].Nombre;
            this.numero_emp = this.archivos[this.indice].No_Empleado;
            this.puesto = this.archivos[this.indice].Puesto;
            this.correo = this.archivos[this.indice].Correo;
            this.area = this.archivos[this.indice].Area;
            this.tipo_pc = this.archivos[this.indice].Tipo;
            this.nombre_equipo = this.archivos[this.indice].Nombre_E;
            this.marca = this.archivos[this.indice].Marca;
            this.modelo = this.archivos[this.indice].Modelo;
            this.no_serie = this.archivos[this.indice].No_Serie;
            this.sistema = this.archivos[this.indice].Sistema;
        },

        OpenFormat1() {
            this.form_type = 1;
            this.formato = true;
            this.modalformat = false;
        },
        async SendFirma()
        {
            this.alert = true;
            this.textalert ="Enviando Solicitud";
            let form = new FormData();
            form.append("id", this.id);
            form.append("tipo", this.tipo_document);
            form.append("correo", this.archivos[this.indice].Correo)
            try{
                const res = await axios.post("sendsolicitud", form);
                if(res.data === true)
                {
                    setTimeout(() => {
                        this.opciones = false;
                        this.SuccesAlert("Se ha enviado la petición con éxito");
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

        ErrorAlert(mensaje) {
            $(function () {
                $.amaran({
                    'theme': 'colorful',
                    'content': {
                        bgcolor: '#c0392b',
                        color: '#fff',
                        message: mensaje
                    },
                    'cssanimationIn': 'shake',
                    'cssanimationOut': 'fadeOutRight',
                    'outEffect': 'slideRight',
                    'position': 'bottom right'
                });

            });
        },

        SuccesAlert(mensaje) {
            $(function () {
                $.amaran({ 'message': mensaje })
            })
        },
    },

    mounted() {
        this.GetAll();
        this.Loadusuarios();
        this.token = document.getElementById("token").value;
        window.addEventListener("keyup", (e) => {
            if (e.key === "Escape") {
                this.formato = false;
                this.formato2 = false;
                this.CleanData();
                this.opciones = false;
                this.modalformat = false;
            }
        })
    },

}).mount("#app");