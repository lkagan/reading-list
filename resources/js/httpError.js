export default function(e) {
    if (! e?.response) {
        alert('No network connection')
    } else {
        console.log(e.response)
        alert('💥 Oops, something went wrong. See JS console.')
    }
}
