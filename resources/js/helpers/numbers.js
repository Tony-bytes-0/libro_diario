export const formatedNumber = (number) => {
    return new Intl.NumberFormat("es-VE", {
        maximumFractionDigits: 2,
        minimumFractionDigits: 2,
    }).format(number);
};

export const formatedDolar = (number) => {
    return new Intl.NumberFormat("en-US", {
        maximumFractionDigits: 2,
        minimumFractionDigits: 2,
    }).format(number);
};


export function formateStringVesToUniversal(str) {
    // Remover puntos (separadores de miles) y reemplazar coma por punto
    if(typeof(str) == 'string'){
        return parseFloat(str.replace(/\./g, "").replace(",", "."));
    }
}
export const formatedDate = (date) => {
    const today = new Date(date);
    const yyyy = today.getFullYear();
    let mm = today.getMonth() + 1; // Months start at 0!
    let dd = today.getDate();
    if (dd < 10) dd = "0" + dd;
    if (mm < 10) mm = "0" + mm;

    return dd + "/" + mm + "/" + yyyy;
}

export function stringToDate(dateString) {
    // Parse the input date string
    const date = new Date(dateString);

    // Get the current time zone offset in minutes
    const offset = new Date().getTimezoneOffset();

    // Adjust the date to match the local time
    const adjustedDate = new Date(date.getTime() + offset * 60 * 1000);

    // Extract year, month, and day
    const year = adjustedDate.getFullYear();
    const month = String(adjustedDate.getMonth() + 1).padStart(2, "0");
    const day = String(adjustedDate.getDate()).padStart(2, "0");

    // Reconstruct the date in the desired format
    return `${day}/${month}/${year}`;
}

export function isDate(dateString){
    return !isNaN(Date.parse(dateString));
}

export const totalize = (key) => {
    let total = 0;
    if (items.value.length > 0) {
        items.value.forEach((x) => {
            total += +x[key];
        });
    }
    return total;
};

export const dinamicTotalize = (key, array) => {
    var total = 0;
       if(array.length > 0){
        array.forEach((x) => {
            const value = parseFloat(x[key])
            total += value
        })
       }
    return total;
};

export function validateNumbersAndCommas(input) {
    const regex = /^[0-9,]+$/;
    return regex.test(input);
}

export const converToArray = (iterable) => {
    const x = [];
    for (const [key, value] of Object.entries(iterable)) {
        x.push({ name: key, value: value }); // Note the square brackets around key
    }
    return x;
};