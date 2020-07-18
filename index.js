const spinner = '<div class="spinner-border text-primary" role="status">' +
                '<span class="sr-only">Loading...</span></div>'

async function loadVehicles(search = "") {
    $("#vehicles-spinner").html(spinner)

    $("#details-submit").attr("disabled", "true")
    $("#details-modelo").html('---')
    $("#details-marca").html('---')
    $("#details-ano").html('---')
    $("#details-descricao").html('---')

    let endPoint = "./api/"
    if(search.trim()) endPoint += "?search=" + search
    
    await $.ajax({
        url: endPoint,
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
            let vehicleDiv = ""
            data.map(vehicle => {
                vehicleDiv +=
                '<div class="row">' +
                    '<div class="card car-card">' +
                        '<div class="card-header">' +
                            '<h5>' +
                            '<a href="#" onClick="seeDetails(1);">' +
                                vehicle.modelo +'</a>' +
                            '</h5>' +
                        '</div>' +
                        '<div class="card-body">' +
                            '<div class="row">' +
                                '<div class="col-sm-9">' +
                                    '<h6>'+ vehicle.ano +'</h6>' +
                                '<h6>'+ vehicle.marca +'</h6>' +
                                '</div>' +
                                '<div class="col-sm-3">' +
                                    '<button class="btn btn-primary" ' +
                                        'onClick="seeDetails('+ vehicle.id +')">Ver detalhes</button>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';
            })
            if(data.length === 0) $("#vehicles-div").html("Não encontramos nada aqui")
            else $("#vehicles-div").html(vehicleDiv)
        },
        error: function(err) {
            $("#vehicles-div").html("<p>Houve um erro ao buscar os veículos</p>")
        }
    });
    $("#vehicles-spinner").html("")
}

async function seeDetails(id) {
    $("#details-spinner").html(spinner)
    $("#details-spinner").focus()
    $("#details-submit").attr("disabled", "true")
    $("#details-modelo").html('---')
    $("#details-marca").html('---')
    $("#details-ano").html('---')
    $("#details-descricao").html('---')

    await $.ajax({
        url: './api/?id=' + id,
        type: 'GET',
        dataType: 'json',
        contentType: 'application/json',
        success: function(data) {
            $("#details-modelo").html(data.veiculo)
            $("#details-marca").html(data.marca)
            $("#details-ano").html(data.ano)
            $("#details-descricao").html(data.descricao)
            $("#details-vendido").val(data.vendido)
            $("#details-id").val(id)
            $("#details-submit").removeAttr("disabled")
        },
        error: function(err) {
            alert('Um erro ocorreu ao buscar os detalhes do veículo')
        }
    })

    $("#details-spinner").html("")
}

function edit() {
    $("#form-id").val($("#details-id").val())
    $("#form-modelo").val($("#details-modelo").html())
    $("#form-marca").val($("#details-marca").html())
    $("#form-ano").val($("#details-ano").html())
    $("#form-descricao").val($("#details-descricao").html())

    const isSold = $("#details-vendido").val() == "1" ? 
        $("#form-vendido").attr("checked", "true") : 
        $("#form-vendido").removeAttr("checked")
    

    $("#form-submit").attr("onClick", "submitEdit()")
}

async function submitEdit() {
    if(!validateVehicle()) return
    $("#form-spinner").html(spinner)

    const vehicle = {
        id: $("#form-id").val(),
        modelo: $("#form-modelo").val(),
        marca: $("#form-marca").val(),
        ano: $("#form-ano").val(),
        descricao: $("#form-descricao").val(),
        vendido: $("#form-vendido").prop("checked") == true ? "1" : "0"
    }

    await $.ajax({
        url: './api/',
        type: 'PUT',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(vehicle),
        success: function(data) {
            alert("O veículo foi atualizado com sucesso")
            $("#form-spinner").html("")
            loadVehicles()
        },
        error: function(err) {
            $("#form-spinner").html("")
            alert('Um erro ocorreu ao atualizar os detalhes do veículo')
        }
    })
}

function add() {
    $("#form-submit").attr("onClick", "submitAdd()")
}

async function submitAdd() {
    if(!validateVehicle()) return
    $("#form-spinner").html(spinner)

    const vehicle = {
        modelo: $("#form-modelo").val(),
        marca: $("#form-marca").val(),
        ano: $("#form-ano").val(),
        descricao: $("#form-descricao").val(),
        vendido: $("#form-vendido").prop("checked") == true ? "1" : "0"
    }

    await $.ajax({
        url: './api/',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        data: JSON.stringify(vehicle),
        success: function(data) {
            alert("O veículo foi adicionado com sucesso")
            $("#form-spinner").html("")
            loadVehicles()
        },
        error: function(err) {
            $("#form-spinner").html("")
            alert('Um erro ocorreu ao adicionar o veículo')
        }
    })
}

function validateVehicle() {
    if($("#form-modelo").val() == "") {
        alert('Preencha o modelo do veículo')
        return false
    }
    if($("#form-marca").val() == "") {
        alert('Preencha a marca do veículo')
        return false
    }
    if($("#form-ano").val() == "") {
        alert('Preencha o ano do veículo')
        return false
    }
    if($("#form-descricao").val() == "") {
        alert('Preencha a descrição do veículo')
        return false
    }
    return true
}