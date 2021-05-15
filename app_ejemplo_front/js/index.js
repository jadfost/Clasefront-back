
const urlApi = "http://localhost/clase/app_ejemplo_php/estudiantes";
let listaEstudiantes = [];
let idEstudiante = 0;
let estudiante = null;

function indexApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaEstudiantes = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlApi, true);
    xhttp.send();
}
indexApi();

function asignarDatosTablaHtml() {
    let html = '';
    for (let item of listaEstudiantes) {
        console.log(item);
        html += '<tr>';
        html += '    <td>' + item.codigo + '</td>';
        html += '    <td>' + item.nombres + ' ' + item.apellidos + '</td>';
        html += '    <td>' + item.edad + '</td>';
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
    const element = document.getElementById('listaEstudiantes').getElementsByTagName('tbody')[0];
    element.innerHTML = html;
}

function datailApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            estudiante = response.data;
        }
    };
    xhttp.open("GET", urlApi + '/' + idEstudiante, false);
    xhttp.send();
}


function saveDataForm(event) {
    event.preventDefault();
    let data = 'codigo=' + document.getElementById('codigo').value;
    data += '&nombres=' + document.getElementById('nombres').value;
    data += '&apellidos=' + document.getElementById('apellidos').value;
    data += '&edad=' + document.getElementById('edad').value;
    save(data);
}

function save(data) {
    let reponse = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            reponse = JSON.parse(this.response);
            console.log(reponse);
            indexApi();
            onClickCancelar();
        }
    };
    let param = idEstudiante > 0 ? '/' + idEstudiante : '';
    let metodo = idEstudiante > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlApi + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

function crear() {
    idEstudiante = 0;
    estudiante = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar datos estudiante';
    document.getElementById('codigo').value = '';
    document.getElementById('nombres').value = '';
    document.getElementById('apellidos').value = '';
    document.getElementById('edad').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function modificar(id) {
    console.log(id);
    idEstudiante = id;
    estudiante = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos estudiante';
    datailApi();
    if (estudiante != null) {
        document.getElementById('codigo').value = estudiante.codigo;
        document.getElementById('nombres').value = estudiante.nombres;
        document.getElementById('apellidos').value = estudiante.apellidos;
        document.getElementById('edad').value = estudiante.edad;
        document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
    }
}

function eliminar(id) {
    console.log(id);
    idEstudiante = id;
    document.getElementsByClassName('popupControll')[2].classList.remove('popupControll-cerrar');
}

function onClickSi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            idEstudiante = 0;
            estudiante = null;
            indexApi();
            document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
        }
    };
    xhttp.open("DELETE", urlApi + '/' + idEstudiante, false);
    xhttp.send();
}

function onClickNo() {
    document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
}

function ver(id) {
    console.log(id);
    idEstudiante = id;
    estudiante = null;
    datailApi();
    if (estudiante != null) {
        document.getElementById('codigoLb').innerText = estudiante.codigo;
        document.getElementById('nombresLb').innerText = estudiante.nombres;
        document.getElementById('apellidosLb').innerText = estudiante.apellidos;
        document.getElementById('edadLb').innerText = estudiante.edad;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }
}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}


