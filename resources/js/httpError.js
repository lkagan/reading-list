export default function(e) {
    if (! e?.response) {
        alert("Can't connect to server")
    } else {
        console.log(e.response)
        alert('💥 Oops, something went wrong. See JS console.')
    }
}
