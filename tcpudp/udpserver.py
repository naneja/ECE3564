from socket import *

"""Create server socket
AF_INET indicates that the underlying network is using IPv4
SOCK_DGRAM means it is a UDP socket (rather than a TCP socket)
"""
serverSocket = socket(AF_INET, SOCK_DGRAM) #(0.0.0.0, 0) UDP
serverSocket.bind(("0.0.0.0", 12000)) 
print("The server is ready to receive")

while True:
  message, clientAddress = serverSocket.recvfrom(2048)
  clientIPA, clientport = clientAddress

  msg = f"""Received message from client: \
    {message.decode()} from {clientIPA}:{clientport}"""
  print(msg)

  modifiedMessage = message.decode().upper()
  serverSocket.sendto(modifiedMessage.encode(), clientAddress)

