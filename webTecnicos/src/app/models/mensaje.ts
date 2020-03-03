export class Mensaje {
    constructor(
        public idEmpresa: string,
        public fechaHora: string,
        public mensaje: string,
        public encargadoLLamar: string
    ) { }
}