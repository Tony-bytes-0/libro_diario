import Swal from "sweetalert2";


export function notNullString(item){
    if(item == null || item == ''){
        console.log('devolviendo null')
        return ' - '
    }
    else{
        return item
    }
}

export const formatedNumber = (number) => {
    if(number == undefined || number == null){
        return 0
    }
    return new Intl.NumberFormat("es-VE", {
        maximumFractionDigits: 2,
        minimumFractionDigits: 2,
    }).format(number);
};


export const staticError = (errorText) => {
    Swal.fire({
        background: "var(--background)",
        color: "var(--foreground)",
        title: "Error",
        text: errorText,
        icon: "error",
    });
}

export const fastMsg = (successText) => {
    Swal.fire({
        background: "var(--background)",
        color: "var(--foreground)",
        title: "Listo!",
        text: successText,
        icon: "success",
        timer: 3000,
        showConfirmButton: false
    });
}
