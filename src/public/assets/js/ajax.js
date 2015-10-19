// See if browser supports AJAX, and return the xmlhttp object
function XMLHttp() {
    var xmlhttp = false;
    try {
        xmlhttp = new XMLHttpRequest();
    } catch (e) {
        IEversions = new array(
            "MSXML2.XMLHHTP.6.0",
            "MSXML2.XMLHHTP.5.0",
            "MSXML2.XMLHHTP.4.0",
            "MSXML2.XMLHHTP.3.0",
            "MSXML2.XMLHHTP",
            "Microsoft.XMLHTTP"
        );

    for (var i = 0; i < IEversions.length && !xmlhttp; i++) {
            try {
                xmlhttp = new ActiveXObject(IEversions[i]);
                } catch (e) {}
        }
    }

    if (!xmlhttp) {
        alert("Your browser is too old, or dysfunctional please consider updating/fixing it");
    } else {
        return xmlhttp;
    }
}
