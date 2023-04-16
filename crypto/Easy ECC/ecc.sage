import random
import hashlib
from sympy import isprime
from Crypto.Cipher import AES
from Crypto.Util.Padding import pad, unpad

eC_p = ?

FLAG = b'lCTF{Центральная_предельная_теорема_гласит_что_выборочное_распределение_среднего_всегда_будет_нормально_распределенным_если_размер_выборки_достаточно_велик.Нет_ничего_действительно_случайного}'

def gimme_a_good_prime():
    rnd_stuf = str(random.getrandbits(0x200)).encode()
    is_prime = int.from_bytes(rnd_stuf, byteorder="big")
    if isprime(is_prime):
        return is_prime
    else:
        return gimme_a_good_prime()
    
p = gimme_a_good_prime()
q = gimme_a_good_prime()
N = p*q
e = 0x10001
enc_p = pow(eC_p,e,N)

def Compute_keypair(G, p):
        n = random.randint(1, (p-1))
        P = n*G
        return n, P

def Compute_shared_secret(P, n):
        S = P*n
        return S.xy()[0]

def encrypt_flag(shared_secret: int):
        sha256 = hashlib.sha1()
        sha256.update(str(shared_secret).encode('ascii'))
        key = sha256.digest()[:16]
        iv = os.urandom(16)
        cipher = AES.new(key, AES.MODE_CBC, iv)
        ciphertext = cipher.encrypt(pad(FLAG, 16))
        data = {}
        data['iv'] = iv.hex()
        data['encrypted_flag'] = ciphertext.hex()
        return data
    
a = -0x23
b = 0x62
E = EllipticCurve(GF(eC_p), [a,b])
G = E.gens()[0]

# Generate keypair
n_a, P1 = Compute_keypair(G, eC_p)
n_b, P2 = Compute_keypair(G, eC_p)

# Calculate shared secret
S1 = Compute_shared_secret(P1, n_b)
S2 = Compute_shared_secret(P2, n_a)

# Check protocol works
assert S1 == S2

flag = encrypt_flag(S1)

print(f"Encrypted_Prime: {enc_p}")
print(f"Base_Point: {G}")
print(f"Alice_Public _ey: {P1}")
print(f"Bob_Public_key: {P2}")
print(f"Encrypted_flag: {flag}")