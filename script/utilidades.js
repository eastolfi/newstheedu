function expandDiv(ctrl, hrefer, $lnkLiteral)
{
    ctl = eval(ctrl);
    hrf = eval(hrefer);

    if (ctl.style.display == "none") {
        ctl.style.display = "";
        hrf.innerHTML = "-&nbsp;" + $lnkLiteral;
    } else {
        ctl.style.display = "none";				
        hrf.innerHTML = "+&nbsp;" + $lnkLiteral;
    }
}

function expandResp(ctrl)
{
    ctl = eval(ctrl);

    if (ctl.style.display == "none") {
        ctl.style.display = "";	
    } else {
        ctl.style.display = "none";						
    }			
}
