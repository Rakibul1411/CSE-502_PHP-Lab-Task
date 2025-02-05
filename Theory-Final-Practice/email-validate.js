function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  return emailRegex.test(email);
}

console.log(validateEmail("test@example.com")); // Output: true
console.log(validateEmail("test\hi@example.com")); // Output: false
console.log(validateEmail('jiI-I@999.a555')); // Output: false

// const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;