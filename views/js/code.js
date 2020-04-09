const checkEmail = email => /^\S+@\S+\.\S+$/i.test(email);
const checkNSS = nss => /^[1-2]\d{2}(?:0[1-9]|1[0-2])\d{2}\d{3}\d{3}$/i.test(nss);
