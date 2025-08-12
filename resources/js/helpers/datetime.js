export function currentYear() {
  return new Date().getFullYear();
}

export function currentMonth() {
  return new Date().getMonth() + 1; // getMonth() returns 0-11
}
