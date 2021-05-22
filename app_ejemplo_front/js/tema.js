
const urlApi = "http://localhost/clase/Clasefront-back/app_ejemplo_php/temas";
const urlApiSubTemas = "http://localhost/clase/Clasefront-back/app_ejemplo_php/subtemas";
let listaTemas = [];
let idTema = 0;
let tema = null;

let listaSubtemas = [];
let idSubtema = 0;
let subtema = null;

function temasApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaTemas = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlApi, true);
    xhttp.send();
}
temasApi();

function subtemasApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaSubtemas = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlApiSubTemas, true);
    xhttp.send();
}
subtemasApi();

function asignarDatosTablaHtml() {
    let html = '';
    for (let item of listaTemas) {
        console.log(item);
        html += '<tr>';
        html += '    <td>' + item.nombre + '</td>';
        html += '    <td>';
        html += '        <div class="contentButtons">';
        html += '           <button class="contentButtons__button contentButtons__button-verde" onclick="ver(' + item.id + ')">Ver detalle</button>';
        html += '           <button class="contentButtons__button contentButtons__button-azul" onclick="modificar(' + item.id + ')">Modificar</button>';
        html += '           <button class="contentButtons__button contentButtons__button-rojo" onclick="eliminar(' + item.id + ')">Eliminar</button>';
        html += '        <div>';
        // html += '        <div class="contentButtons">';
        // html += '           <button class="button verde" onclick="ver(' + item.id + ')">Ver detalle</button>';
        // html += '           <button class="button azul" onclick="modificar(' + item.id + ')">Modificar</button>';
        // html += '           <button class="button rojo" onclick="eliminar(' + item.id + ')">Eliminar</button>';
        // html += '        <div>';
        html += '    </td>';
        html += '</tr>';
    }
    if (html == '') {
        html += '<tr>';
        html += '    <td class="3">No hay datos registrados</td>';
        html += '</tr>';
    }
    const element = document.getElementById('listaAutores').getElementsByTagName('tbody')[0];
    element.innerHTML = html;
}

function datailApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            tema = response.data;
        }
    };
    xhttp.open("GET", urlApi + '/' + idTema, false);
    xhttp.send();
}

function datailApisub() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            subtema = response.data;
        }
    };
    xhttp.open("GET", urlApiSubTemas + '/' + idSubtema, false);
    xhttp.send();
}


function saveDataForm(event) {
    event.preventDefault();
    let data = '&nombre=' + document.getElementById('nombre').value;
    save(data);
}

function save(data) {
    let reponse = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            reponse = JSON.parse(this.response);
            console.log(reponse);
            temasApi();
            onClickCancelar();
        }
    };
    let param = idTema > 0 ? '/' + idTema : '';
    let metodo = idTema > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlApi + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

function crear() {
    idTema = 0;
    tema = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar datos tema';
    document.getElementById('nombre').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function setsubtema(){
    let valor = '';
    valor += '<select class="control-input__input" name="subtemas" id="subtemas" type="text" value="" required>'
    for (let subtema of listaSubtemas){
        valor += '<option value ="'+subtema.id+'">'+subtema.nombre+'</option>';
    }
    valor+='</select>';
    document.getElementById('subtemas').innerHTML=valor;
}

function modificar(id) {
    console.log(id);
    idTema = id;
    tema = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos tema';
    datailApi();
    if (tema != null) {
        document.getElementById('nombre').value = tema.nombre;
        document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
    }
}

function eliminar(id) {
    console.log(id);
    idTema = id;
    document.getElementsByClassName('popupControll')[2].classList.remove('popupControll-cerrar');
}

function onClickSi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            idTema = 0;
            tema = null;
            temasApi();
            document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
        }
    };
    xhttp.open("DELETE", urlApi + '/' + idTema, false);
    xhttp.send();
}

function onClickNo() {
    document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
}

function ver(id) {
    console.log(id);
    idTema = id;
    tema = null;
    datailApi();
    if (tema != null) {
        document.getElementById('nombreLb').innerText = tema.nombre;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }

}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}


