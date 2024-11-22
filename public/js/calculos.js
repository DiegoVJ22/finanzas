// Factor Simple de Capitalización (FSC)
function calculateFSC(P, i, n) {
    console.log(n);
    const result = P * Math.pow(1 + i, n);
    return result;
}

// Factor Simple de Actualización (FSA)
function calculateFSA(S, i, n) {
    const result = S / Math.pow(1 + i, n);
    return result;
}

// Factor de Recuperación de Capital (FRC)
function calculateFRC(P, i, n) {
    const numerator = i * Math.pow(1 + i, n);
    const denominator = Math.pow(1 + i, n) - 1;
    const result = P * (numerator / denominator);
    return result;
}

// Factor de Actualización de la Serie (FAS)
function calculateFAS(R, i, n) {
    const numerator = Math.pow(1 + i, n) - 1;
    const denominator = i * Math.pow(1 + i, n);
    const result = R * (numerator / denominator);
    return result;
}

// Factor de Capitalización de la Serie (FCS)
function calculateFCS(R, i, n) {
    const numerator = Math.pow(1 + i, n) - 1;
    const result = R * (numerator / i);
    return result;
}

// Factor de Depósito del Fondo de Amortización (FDFA)
function calculateFDFA(S, i, n) {
    const denominator = Math.pow(1 + i, n) - 1;
    const result = S * (i / denominator);
    return result;
}

function calculateIeq(i, f, c, m) {
    if (f === c && c === m) {
        return i;
    } else if (f == c && c != m) {
        const base = 1 + i;
        switch (f) {
            case "diaria":
                a = 1;
                break;
            case "semanal":
                a = 7;
                break;
            case "mensual":
                a = 30;
                break;
            case "bimestral":
                a = 60;
                break;
            case "trimestral":
                a = 90;
                break;
            case "semestral":
                a = 180;
                break;
            default:
                a = 360;
                break;
        }
        switch (m) {
            case "diaria":
                b = 1;
                break;
            case "semanal":
                b = 7;
                break;
            case "mensual":
                b = 30;
                break;
            case "bimestral":
                b = 60;
                break;
            case "trimestral":
                b = 90;
                break;
            case "semestral":
                b = 180;
                break;
            default:
                b = 360;
                break;
        }
        const exponent = b / a;
        const result = Math.pow(base, exponent) - 1;
        return result;
    } else if (f != c) {
        const base = 1 + i;
        switch (c) {
            case "diaria":
                a = 1;
                break;
            case "semanal":
                a = 7;
                break;
            case "mensual":
                a = 30;
                break;
            case "bimestral":
                a = 60;
                break;
            case "trimestral":
                a = 90;
                break;
            case "semestral":
                a = 180;
                break;
            default:
                a = 360;
                break;
        }
        switch (f) {
            case "diaria":
                b = 1;
                break;
            case "semanal":
                b = 7;
                break;
            case "mensual":
                b = 30;
                break;
            case "bimestral":
                b = 60;
                break;
            case "trimestral":
                b = 90;
                break;
            case "semestral":
                b = 180;
                break;
            default:
                b = 360;
                break;
        }
        const exponent = a / b;
        const result = Math.pow(base, exponent) - 1;
        return result;
    }
}

function calculateIeq2(i, f, l) {
    if (f != l) {
        const base = 1 + i;
        switch (l) {
            case "diaria":
                a = 1;
                break;
            case "semanal":
                a = 7;
                break;
            case "mensual":
                a = 30;
                break;
            case "bimestral":
                a = 60;
                break;
            case "trimestral":
                a = 90;
                break;
            case "semestral":
                a = 180;
                break;
            default:
                a = 360;
                break;
        }
        switch (f) {
            case "diaria":
                b = 1;
                break;
            case "semanal":
                b = 7;
                break;
            case "mensual":
                b = 30;
                break;
            case "bimestral":
                b = 60;
                break;
            case "trimestral":
                b = 90;
                break;
            case "semestral":
                b = 180;
                break;
            default:
                b = 360;
                break;
        }
        const exponent = a / b;
        const result = Math.pow(base, exponent) - 1;
        return result;
    } else {
        return i;
    }
}

function esMenor(m, c) {
    switch (m) {
        case "diaria":
            a = 1;
            break;
        case "semanal":
            a = 7;
            break;
        case "mensual":
            a = 30;
            break;
        case "bimestral":
            a = 60;
            break;
        case "trimestral":
            a = 90;
            break;
        case "semestral":
            a = 180;
            break;
        default:
            a = 360;
            break;
    }
    switch (c) {
        case "diaria":
            b = 1;
            break;
        case "semanal":
            b = 7;
            break;
        case "mensual":
            b = 30;
            break;
        case "bimestral":
            b = 60;
            break;
        case "trimestral":
            b = 90;
            break;
        case "semestral":
            b = 180;
            break;
        default:
            b = 360;
            break;
    }
    return a < b;
}

function valorN(c, m, n) {
    if (m != c) {
        switch (c) {
            case "diaria":
                a = 1;
                break;
            case "semanal":
                a = 7;
                break;
            case "mensual":
                a = 30;
                break;
            case "bimestral":
                a = 60;
                break;
            case "trimestral":
                a = 90;
                break;
            case "semestral":
                a = 180;
                break;
            default:
                a = 360;
                break;
        }
        switch (m) {
            case "diaria":
                b = 1;
                break;
            case "semanal":
                b = 7;
                break;
            case "mensual":
                b = 30;
                break;
            case "bimestral":
                b = 60;
                break;
            case "trimestral":
                b = 90;
                break;
            case "semestral":
                b = 180;
                break;
            default:
                b = 360;
                break;
        }
        console.log("b: " + b);
        console.log("a: " + a);
        return n * (b / a);
    } else {
        return n;
    }
}

// Función que maneja la lógica de cada botón
function handleCalculation(formType) {
    let P, S, R, i, n, result;

    // Obtener los valores de los inputs
    switch (formType) {
        case "FSC":
            P = parseFloat(document.getElementById("P1").value);
            n = parseFloat(document.getElementById("n1").value);
            i = parseFloat(document.getElementById("i1").value);
            f = document.getElementById("frecuencia1").value;
            c = document.getElementById("capitalizacion1").value;
            m = document.getElementById("m1").value;
            ieq = calculateIeq(i / 100, f, c, m);
            aux = esMenor(m, c);
            if (aux) {
                alert("La capitalización no puede ser mayor que el periodo");
            } else {
                n = valorN(c, m, n);
                result = calculateFSC(P, ieq, n);
                console.log(result);
                document.getElementById("resultado1").value = result.toFixed(2); // Redondeo a dos decimales
            }
            break;
        case "FSA":
            S = parseFloat(document.getElementById("S2").value);
            n = parseFloat(document.getElementById("n2").value);
            i = parseFloat(document.getElementById("i2").value);
            f = document.getElementById("frecuencia2").value;
            c = document.getElementById("capitalizacion2").value;
            m = document.getElementById("m2").value;
            ieq = calculateIeq(i / 100, f, c, m);
            aux = esMenor(m, c);
            if (aux) {
                alert("La capitalización no puede ser mayor que el periodo");
            } else {
                n = valorN(c, m, n);
                result = calculateFSA(S, ieq, n);
                console.log(result);
                document.getElementById("resultado2").value = result.toFixed(2); // Redondeo a dos decimales
            }
            break;
        case "FRC":
            P = parseFloat(document.getElementById("P3").value);
            n = parseFloat(document.getElementById("n3").value);
            i = parseFloat(document.getElementById("i3").value);
            result = calculateFRC(P, i / 100, n);
            f = document.getElementById("frecuencia3").value;
            m = document.getElementById("m3").value;
            l = document.getElementById("l3").value;
            ieq = calculateIeq2(i / 100, f, l);
            n = valorN(l, m, n);
            result = calculateFRC(P, ieq, n);
            console.log(result);
            document.getElementById("resultado3").value = result.toFixed(2); // Redondeo a dos decimales
            break;
        case "FAS":
            R = parseFloat(document.getElementById("R4").value);
            n = parseFloat(document.getElementById("n4").value);
            i = parseFloat(document.getElementById("i4").value);
            f = document.getElementById("frecuencia4").value;
            c = document.getElementById("c4").value;
            m = document.getElementById("m4").value;
            ieq = calculateIeq2(i / 100, f, c);
            n = valorN(c, m, n);
            result = calculateFAS(R, ieq, n);
            console.log(result);
            document.getElementById("resultado4").value = result.toFixed(2); // Redondeo a dos decimales
            break;
        case "FCS":
            R = parseFloat(document.getElementById("R5").value);
            n = parseFloat(document.getElementById("n5").value);
            i = parseFloat(document.getElementById("i5").value);
            f = document.getElementById("frecuencia5").value;
            c = document.getElementById("c5").value;
            m = document.getElementById("m5").value;
            ieq = calculateIeq2(i / 100, f, c);
            n = valorN(c, m, n);
            console.log(R + " " + ieq + " " + n);
            result = calculateFCS(R, ieq, n);
            console.log(result);
            document.getElementById("resultado5").value = result.toFixed(2); // Redondeo a dos decimales
            break;
        case "FDFA":
            S = parseFloat(document.getElementById("S6").value);
            n = parseFloat(document.getElementById("n6").value);
            i = parseFloat(document.getElementById("i6").value);
            f = document.getElementById("frecuencia6").value;
            m = document.getElementById("m6").value;
            l = document.getElementById("l6").value;
            ieq = calculateIeq2(i / 100, f, l);
            n = valorN(l, m, n);
            result = calculateFDFA(S, ieq, n);
            console.log(result);
            document.getElementById("resultado6").value = result.toFixed(2); // Redondeo a dos decimales
            break;
        default:
            result = "Operación no válida";
    }
}

// Asignar funcionalidad a los botones "Calcular"
document.querySelectorAll('button[type="submit"]').forEach((button) => {
    button.addEventListener("click", function (event) {
        event.preventDefault(); // Evita el envío del formulario
        const formType = this.closest(".card")
            .querySelector("h5")
            .innerText.split("(")[1]
            .split(")")[0];
        handleCalculation(formType);
    });
});
