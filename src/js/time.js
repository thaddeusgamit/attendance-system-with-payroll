const date = new Date(); 
    const userTimezoneOffset = date. getTimezoneOffset() * 60000; 
    const data = new Date(date.getTime()-userTimezoneOffset);
document.getElementById("time").innerHTML = data.toUTCString().slice(0, 22);