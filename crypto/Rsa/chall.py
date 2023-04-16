from Crypto.Util.number import *
from secret import flag

p = getPrime(128)
q = getPrime(128)

n = p * q
e = 2
m = b"**********"
m = bytes_to_long(m)
c  = pow(m, e, n)

